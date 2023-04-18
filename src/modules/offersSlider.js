import Splide from "@splidejs/splide";
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';

class OffersSlider {
  constructor() {
    this.splideContainer = document.getElementById('offers-Slider')
    this.sliderInterval = 1000;
    this.transitionSpeed = 1000;
    this.events();
  }
  events = () => {
    document.addEventListener("DOMContentLoaded", () => {
      this.splideContainer && this.sliderMount();
    });
  };
  sliderMount = () => {
    var offersSlider = new Splide("#offers-Slider", {
      type: 'loop',
      drag: 'free',
      perPage: 2,
      isNavigation: false,
      arrows: false,
      pagination: false,
      pauseOnFocus: false,
      pauseOnHover: false,
      autoStart: true,
      gap: 10,
      autoScroll: {
        speed: 0.5,
        pauseOnFocus: false,
        pauseOnHover: false,
      },
      breakpoints: {
        1024: {
          perPage: 1,
          autoScroll: {
            speed: 0.5
          }
        }
      }
    });
    offersSlider.mount({ AutoScroll });
  };
}

export default OffersSlider;
