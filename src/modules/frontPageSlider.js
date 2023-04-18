import Splide from '@splidejs/splide';


class FrontPageSlider {
    constructor() {
        this.splideContainer = document.getElementById('front-page-slider')
        this.sliderInterval = 10000
        this.transitionSpeed = 3000
        this.events()
    }
    events = () => {
        document.addEventListener('DOMContentLoaded', () => {
            this.splideContainer && this.sliderMount();
        });
    }
    sliderMount = () => {
        var frontSlider = new Splide('#front-page-slider', {
            type: 'fade',
            speed: this.transitionSpeed,
            arrows: false,
            pagination: false,
            autoplay: true,
            interval: this.sliderInterval,
            rewind: true,
            perPage: 1,
            pauseOnFocus: false,
            pauseOnHover: false
        });
        frontSlider.mount();
    }
}


export default FrontPageSlider

