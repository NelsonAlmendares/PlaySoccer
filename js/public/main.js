/* Animación principal usando en scroll en Y del sitio */
window.addEventListener("scroll", function(){
    let header = document.querySelector("header");
    header.classList.toggle("abajo", window.scrollY>0);
})