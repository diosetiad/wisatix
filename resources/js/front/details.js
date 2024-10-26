import Swiper from "swiper/bundle";
import "swiper/css/bundle";
import Plyr from "plyr";
import "plyr/dist/plyr.css";

const swiper = new Swiper(".swiper", {
    direction: "horizontal",
    slidesPerView: "auto",
    pagination: {
        el: ".swiper-pagination",
        type: "bullets",
        renderBullet: function (index, className) {
            return (
                '<div class="!flex max-[460px]:!w-[25px] !w-[50px] !rounded-[50px] !h-1 !shrink-0 ' +
                className +
                '"></div>'
            );
        },
        bulletActiveClass: "swiper-pagination-bullet-active",
        clickable: "true",
    },
});

const player = new Plyr("#player", {
    controls: ["play-large"],
    speed: { selected: 1 },
});

const playBtn = document.getElementById("playBtn");

if (playBtn) {
    let played = false;

    playBtn.addEventListener("click", () => {
        if (!played) {
            player.play();
            played = true;
        } else {
            player.pause();
            played = false;
        }
    });
}
