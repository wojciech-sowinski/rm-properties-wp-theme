class Flip {

    constructor() {

        this.flips = document.querySelectorAll('.flip')
        this.flipItems = [...this.flips]
        this.events()
    }

    events = () => {
        document.addEventListener('scroll', () => {
            this.flipItems.forEach((element, index) => this.checkIsVisible(element, index))
        })
        document.addEventListener('DOMContentLoaded', () => {
            this.flipItems.forEach((element, index) => this.checkIsVisible(element, index))
        })
    }

    checkIsVisible = (element, index) => {
        console.log('flip');
        if (element.getBoundingClientRect().y < window.innerHeight) {
            element.classList.add('visible')
            element.style.transitionDelay = `${0 + (index / 10)}s`
        }
    }
}


export default Flip