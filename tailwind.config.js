/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php", 
    "./resources/**/*.js", 
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
      colors: {
        neoBg: 'var(--background)',
        neoSidebar: 'var(--sidebar-bg)',
        neoMint: 'var(--mint)',
        neoPink: 'var(--pink)',
        neoYellow: 'var(--yellow)',
        neoIndigo: 'var(--indigo-brut)',
        destructive: 'var(--destructive)',
        ink: 'var(--ink)',
        neoCard: 'var(--card-bg)',
        neoBorder: 'var(--border-color)',
        neoMuted: 'var(--muted-text)',
      }
    },
  },
  plugins: [],
}