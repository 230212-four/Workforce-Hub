<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = SystemNotification::query()
            ->with('user')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json(['data' => $notifications]);
    }

    public function markAllRead(Request $request)
    {
        $count = SystemNotification::query()
            ->where('user_id', $request->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'message' => 'All notifications marked as read.',
            'count' => $count,
        ]);
    }

    public function store(Request $request)
    {
        $this->ensureAdmin($request);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'type' => ['nullable', 'in:info,success,warning,error'],
            'data' => ['nullable', 'array'],
        ]);

        $notification = SystemNotification::query()->create([
            ...$validated,
            'type' => $validated['type'] ?? 'info',
        ]);

        return response()->json([
            'message' => 'Notification created.',
            'data' => $notification->load('user'),
        ], 201);
    }

    public function show(Request $request, SystemNotification $notification)
    {
        $this->ensureOwner($request, $notification);

        return response()->json([
            'data' => $notification->load('user'),
        ]);
    }

    public function update(Request $request, SystemNotification $notification)
    {
        $this->ensureOwner($request, $notification);

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'message' => ['sometimes', 'required', 'string'],
            'type' => ['nullable', 'in:info,success,warning,error'],
            'data' => ['nullable', 'array'],
            'read_at' => ['nullable', 'date'],
        ]);

        $notification->update($validated);

        return response()->json([
            'message' => 'Notification updated.',
            'data' => $notification->fresh()->load('user'),
        ]);
    }

    public function destroy(Request $request, SystemNotification $notification)
    {
        $this->ensureOwner($request, $notification);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted.']);
    }

    private function ensureOwner(Request $request, SystemNotification $notification): void
    {
        if ($request->user()->role !== 'admin' && (int) $notification->user_id !== (int) $request->user()->id) {
            throw new HttpResponseException(response()->json(['message' => 'Forbidden.'], 403));
        }
    }

    private function ensureAdmin(Request $request): void
    {
        if ($request->user()->role !== 'admin') {
            throw new HttpResponseException(response()->json(['message' => 'Forbidden.'], 403));
        }
    }
}
