import Splide from '@splidejs/splide';


class OfferGallery {
    constructor() {
        this.splideContainer = document.getElementById('offer-thumbnails')
        this.events()
    }
    events = () => {
        document.addEventListener('DOMContentLoaded', () => {
            this.splideContainer && this.sliderMount();
        });
    }
    sliderMount = () => {
        var main = new Splide('#offer-carousel', {
            type: 'loop',
            height: '25rem',
            focus: 'center',
            width: '100%',
            arrows: true,
            autoplay: false,
        });
        var thumbnails = new Splide('#offer-thumbnails', {
            fixedWidth: 100,
            fixedHeight: 60,
            gap: 10,
            rewind: true,
            pagination: false,
            isNavigation: true,
            breakpoints: {
                600: {
                    fixedWidth: 60,
                    fixedHeight: 44,
                },
            },
        });
        main.sync(thumbnails);
        main.mount();
        thumbnails.mount();
    }
}


export default OfferGallery

