const themeMeta = document.querySelector('meta[name="user-theme"]')
const userTheme = themeMeta ? themeMeta.content : 'system'

if (userTheme === 'system') {
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')
    document.documentElement.classList.toggle('dark', mediaQuery.matches)
    
    mediaQuery.addEventListener('change', (e) => {
        console.log('System theme changed:', e.matches ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', e.matches)
    })
}

if (userTheme === 'dark') {
    document.documentElement.classList.add('dark')
} else if (userTheme === 'light') {
    document.documentElement.classList.remove('dark')
}