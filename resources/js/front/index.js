import Swiper from "swiper";
import "swiper/css";

const swiper = new Swiper(".swiper", {
    direction: "horizontal",
    spaceBetween: 16,
    slidesOffsetBefore: 16,
    slidesOffsetAfter: 16,
    slidesPerView: "auto",
});
