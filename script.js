let slider = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');

let lengthItems = items.length - 1;
let active = 0;

next.onclick = function(){
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
}

prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
}

function reloadSlider(){
    slider.style.left = -items[active].offsetLeft + 'px';
}

// Ensure the slider displays correctly on window resize
window.onresize = function(event) {
    reloadSlider();
};

// Initial call to set the slider to the correct position
reloadSlider();

//gallery sliding
document.addEventListener('DOMContentLoaded', function () {
    let box = document.querySelector('.gallery .box');
    let items = document.querySelectorAll('.gallery .box img');
    let nextGallery = document.getElementById('gallery-next');
    let prevGallery = document.getElementById('gallery-prev');

    let activeIndex = 0;
    const itemWidth = items[0].offsetWidth + 40;
    const totalItems = items.length;

    function updateGallery() {
        box.style.transform = `translateX(-${activeIndex * itemWidth}px)`;
    }

    nextGallery.addEventListener('click', function () {
        if (activeIndex < totalItems - 1) {
            activeIndex++;
            updateGallery();
        }
    });

    prevGallery.addEventListener('click', function () {
        if (activeIndex > 0) {
            activeIndex--;
            updateGallery();
        }
    });
    window.addEventListener('resize', function () {
        updateGallery();
    });
    updateGallery();
});





