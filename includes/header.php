<?php

add_action('genesis_after_header', 'freelance_background_illustration', 8);

function freelance_background_illustration()
{
	if (is_front_page() && is_active_sidebar('front-page-1')) {
		?>
		<svg class="background-illustration" viewBox="0 0 838 1171" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Mockups" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Desktop" transform="translate(-790.000000, 0.000000)" fill="#FC5C65">
            <path d="M1017.03364,-29 L1848,-29 L1848,1171 L1603.21995,1171 C1587.91661,1171 1573.45598,1163.99184 1563.97404,1151.97997 L800.965859,185.389134 C783.856096,163.714215 787.556886,132.273017 809.231804,115.163254 C810.044152,114.522002 810.876214,113.906128 811.726787,113.316519 L1017.03364,-29 Z" id="Rectangle-3"></path>
        </g>
    </g>
</svg>
		<?php

}
}