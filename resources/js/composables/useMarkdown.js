/**
 * Lightweight Markdown → HTML parser.
 * Supports: # headings, **bold**, *italic*, - bullet lists, paragraphs.
 * Text is HTML-escaped before processing to prevent XSS.
 */

function escapeHtml(str) {
  return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
}

function parseInline(line) {
  // Bold: **text**
  line = line.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
  // Italic: *text* (but not inside **)
  line = line.replace(/(?<!\*)\*(?!\*)(.+?)(?<!\*)\*(?!\*)/g, '<em>$1</em>')
  return line
}

export function renderMarkdown(raw) {
  if (!raw || typeof raw !== 'string') return ''

  const escaped = escapeHtml(raw)
  const lines = escaped.split('\n')
  const html = []
  let inList = false

  for (let i = 0; i < lines.length; i++) {
    const line = lines[i]

    // Headings
    if (line.startsWith('### ')) {
      if (inList) { html.push('</ul>'); inList = false }
      html.push(`<h3>${parseInline(line.slice(4))}</h3>`)
      continue
    }
    if (line.startsWith('## ')) {
      if (inList) { html.push('</ul>'); inList = false }
      html.push(`<h2>${parseInline(line.slice(3))}</h2>`)
      continue
    }
    if (line.startsWith('# ')) {
      if (inList) { html.push('</ul>'); inList = false }
      html.push(`<h1>${parseInline(line.slice(2))}</h1>`)
      continue
    }

    // Bullet list items
    if (line.startsWith('- ')) {
      if (!inList) { html.push('<ul>'); inList = true }
      html.push(`<li>${parseInline(line.slice(2))}</li>`)
      continue
    }

    // End list if we're no longer on a list item
    if (inList) { html.push('</ul>'); inList = false }

    // Empty line → skip (don't add empty paragraphs)
    if (line.trim() === '') continue

    // Paragraph
    html.push(`<p>${parseInline(line)}</p>`)
  }

  if (inList) html.push('</ul>')

  return html.join('\n')
}

/**
 * Truncate raw markdown to a max character count, then render.
 */
export function renderMarkdownTruncated(raw, maxChars = 80) {
  if (!raw || typeof raw !== 'string') return ''
  const truncated = raw.length > maxChars ? raw.slice(0, maxChars) + '…' : raw
  return renderMarkdown(truncated)
}
