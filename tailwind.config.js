/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php", 
    "./resources/**/*.js", 
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {
      colors: {
        neoBg: 'var(--background)',
        neoSidebar: 'var(--cream-cool)',
        neoMint: 'var(--mint)',
        neoPink: 'var(--pink)',
        neoYellow: 'var(--yellow)',
        neoIndigo: 'var(--indigo-brut)',
        destructive: 'var(--destructive)',
        ink: 'var(--ink)',
      }
    },
  },
  plugins: [],
}