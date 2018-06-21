AOS.init()
const headerWrapper = document.querySelector( '.site-header .wrap' )
const navPrimary = headerWrapper.querySelector( 'nav' )

const button = document.createElement( 'button' );
button.classList.add( 'menu-toggle' );
button.setAttribute( 'aria-expanded', 'false' );
button.setAttribute( 'aria-pressed', 'false' );
button.textContent = 'Menu'
button.style.display = 'none'

headerWrapper.insertBefore( button, navPrimary );
