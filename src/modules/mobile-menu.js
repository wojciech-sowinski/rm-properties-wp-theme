class MobileMenu {

    constructor() {
        this.triggerBtn = document.querySelector('span.mobile-menu-trigger')
        this.mainNav = document.querySelector('nav.main-nav')
        this.events()
    }

    events = () => {
        this.triggerBtn.addEventListener('click', () => {
            this.toogleShowMenuHandle()
        })
    }

    toogleShowMenuHandle = () => {
        this.mainNav.classList.toggle('open')
        this.triggerBtn.classList.toggle('open')
        this.open = !this.open
    }
}

export default MobileMenu