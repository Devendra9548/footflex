@extends('templates.front.main')
@section('customcss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
fieldset {
    line-height: 1;
}

.preferences {
    padding: 1em;
    margin-block: 2em;
    border-radius: 8px;
    border-color: rgb(245 245 245 / 0.4);
    background: #131921;

    & .legend {
        padding: 0.5em 1em;
        border-radius: 9999px;
        font-weight: 500;
        color: #fff;
    }
}

.preferences p,
.preferences span {
    color: #fff !important;
}

.switch-container {
    padding: 1em;
    width: min(14em, 100%);
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    row-gap: 1em;
    cursor: pointer;
    border-radius: 8px;

    &:hover,
    &:has(input:focus),
    &:has(input:focus-visible) {
        outline: 2px solid var(--accent-light);
    }
}

.label {
    margin-right: 1em;
}

.switch {
    --_switch-height: 24px;
    --_switch-width: 48px;

    position: relative;
    margin-right: 0.5em;
    height: var(--_switch-height);
    width: var(--_switch-width);

    /* Hide default HTML checkbox but preserve accessibility. */
    & input {
        opacity: 0;
        width: 0;
        height: 0;
    }
}

/* The slider */
.slider {
    --outline-width: 1px;

    position: absolute;
    inset: 0;

    background-color: var(--primary-dark-light);
    border-radius: 9999px;
    outline: 1px solid whitesmoke;
    cursor: pointer;
    transition: background-color var(--transition-duration-timing-from);

    &::before {
        --_ratio: 80%;
        --_offset: 2px;

        content: "";

        position: absolute;
        top: 50%;
        left: var(--_offset);
        right: unset;
        translate: 0 -50%;

        height: var(--_ratio);
        aspect-ratio: 1 / 1;

        background-color: rgba(245 245 245 / 0.85);
        border-radius: 50%;

        transition: translate var(--transition-duration-timing-from);
    }

    .switch input:checked+& {
        background-color: var(--accent);
        filter: brightness(130%);
        transition: background-color var(--transition-duration-timing-to);
    }

    .switch input:checked+&::before {
        left: 0;
        translate: calc(calc(var(--_switch-width) - 100%) - var(--_offset)) -50%;
        transition: translate var(--transition-duration-timing-to);
    }
}

.switch-status {
    color: whitesmoke;
    opacity: 0.85;

    .switch:has(#switch-toggle[checked])+& {
        opacity: 1;
        font-weight: 500;
    }
}

.accordion {
    /* Apply border radius to the parent container... */
    border-radius: 8px;
    /* ...and set overflow hidden to crop its children so the border remains visible. */
    overflow: hidden;
    border: 1px solid #000 !important;
    margin-bottom: 30px !important;

    &:has(.accordion-toggle:focus-visible),
    &:has(.accordion-toggle:focus) {
        outline: 2px solid var(--accent-light);
    }
}

.accordion button {
    border: 0px !important;
}

.accordion button h2 {
    margin-bottom: 0px !important;
    line-height: 1.5 !important;
    font-size: 18px !important;
}

.accordion-toggle {
    padding: 0.5em 1em;
    margin-bottom: 0;
    width: 100%;

    display: flex;
    justify-content: space-between;
    align-items: center;

    background-color: var(--accent);
    cursor: pointer;

    &:focus-visible,
    &:focus,
    &:hover,
    &[aria-expanded="true"] {
        filter: brightness(140%);
    }
}

.accordion .content-container {
    border-top: 1px solid #000 !important;
}

.btn-icon {
    position: relative;
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    background-color: var(--accent-light);
    border-radius: 100vmax;

    &::before,
    &::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        translate: -50% -50%;

        height: 4px;
        width: calc(100% - 0.75em);

        background-color: var(--accent);
    }

    &::after {
        rotate: 90deg;
    }

    .accordion-toggle[aria-expanded="true"] &::before,
    .accordion-toggle[aria-expanded="true"] &::after {
        rotate: 180deg;
    }

    /* The prefers-reduced-motion feature query detects whether the user has requested the operating system to minimize the amount of animation or motion it uses */
    @media (prefers-reduced-motion: no-preference) {

        &::before,
        &::after {
            /* Transition from '-' to '+'. */
            transition: rotate var(--transition-duration-timing-from);
        }

        /* Transition from '+' to -'. */
        .accordion-toggle[aria-expanded="true"] &::before,
        .accordion-toggle[aria-expanded="true"] &::after {
            transition: rotate var(--transition-duration-timing-to);
        }
    }
}

.accordion-panel {
    display: grid;
    grid-template-rows: 0fr;
    visibility: hidden;
    opacity: 0;

    .accordion-toggle[aria-expanded="true"]+& {
        grid-template-rows: 1fr;
        visibility: visible;
        opacity: 1;
    }

    @media (prefers-reduced-motion: no-preference) {
        transition: grid-template-rows var(--transition-duration-timing-from),
            visibility var(--transition-duration-timing-delay-from),
            opacity var(--transition-duration-timing-from);

        .accordion-toggle[aria-expanded="true"]+& {
            transition: grid-template-rows var(--transition-duration-timing-to),
                visibility 0s 0s ease-out, opacity var(--transition-duration-timing-to);
        }
    }
}

.accordion-drawer {
    color: var(--primary-dark);
    background-color: var(--accent-light);
    overflow: hidden;
}

/* Additional div to add padding to the content without messing with the animation. */
.content-container {
    padding: 1em;

    p {
        text-align: left;
    }
}
</style>
@endsection
@section('body')
<div class="container-fluid breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p style="margin:0px" class="py-3"><a href="/">Home</a> » <a href="#">F.A.Q</a></p>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <main>
                <div class="container">
                    <fieldset class="preferences">
                        <legend class="legend">Preferences</legend>
                        <label for="switch-toggle" title="Allow a single accordion panel to be expanded at a time"
                            class="switch-container">
                            <span id="switch-label" class="label">Solo mode</span>
                            <div class="switch">
                                <input id="switch-toggle" type="checkbox" role="switch"
                                    aria-labelledby="switch-label" />
                                <span class="slider"></span>
                            </div>
                            <span id="switch-status" class="switch-status" aria-hidden="true">OFF</span>
                        </label>
                    </fieldset>

                    <section>
                        <div class="accordion">
                            <button type="button" id="accordion-toggle-01" class="accordion-toggle"
                                aria-controls="accordion-panel-01" aria-expanded="false">
                                <h2>What payment methods do you accept?</h2>
                                <span class="btn-icon" aria-hidden="true"></span>
                            </button>
                            <div id="accordion-panel-01" class="accordion-panel" aria-labelledby="accordion-toggle-01">
                                <!-- Additional div to smoothen grid 0 -> 1fr transition -->
                                <div class="accordion-drawer">
                                    <!-- Additional div to add padding to the content without messing with the animation -->
                                    <div class="content-container">
                                        <p>At DS, we strive to make your shopping experience as convenient as
                                            possible. We accept a variety of payment methods, including major credit
                                            cards (Visa, Mastercard, American Express), PayPal, and direct bank
                                            transfers. Rest assured, your payment information is kept secure through
                                            encrypted transactions, ensuring your peace of mind while you shop with us.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="accordion">
                            <button type="button" id="accordion-toggle-02" class="accordion-toggle"
                                aria-controls="accordion-panel-02" aria-expanded="false">
                                <h2>How do I track my order?</h2>
                                <span class="btn-icon" aria-hidden="true"></span>
                            </button>
                            <div id="accordion-panel-02" class="accordion-panel" aria-labelledby="accordion-toggle-02">
                                <!-- Additional div to smoothen grid 0 -> 1fr transition -->
                                <div class="accordion-drawer">
                                    <!-- Additional div to add padding to the content without messing with the animation -->
                                    <div class="content-container">
                                        <p>Tracking your order with DS is simple and hassle-free. Once your
                                            order has been processed and shipped, you will receive a confirmation email
                                            containing a tracking number and instructions on how to monitor your
                                            package's journey. You can easily track the status of your delivery by
                                            entering the provided tracking number on our website's designated tracking
                                            page or through our chosen courier's online portal.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="accordion">
                            <button type="button" id="accordion-toggle-03" class="accordion-toggle"
                                aria-controls="accordion-panel-03" aria-expanded="false">
                                <h2>What is your return policy?</h2>
                                <span class="btn-icon" aria-hidden="true"></span>
                            </button>
                            <div id="accordion-panel-03" class="accordion-panel" aria-labelledby="accordion-toggle-03">
                                <!-- Additional div to smoothen grid 0 -> 1fr transition -->
                                <div class="accordion-drawer">
                                    <!-- Additional div to add padding to the content without messing with the animation -->
                                    <div class="content-container">
                                        <p>Your satisfaction is our priority at DS. If for any reason you're
                                            not completely satisfied with your purchase, we offer a straightforward
                                            return policy to ensure your peace of mind. Within [X] days of receiving
                                            your order, simply contact our customer service team to initiate the return
                                            process. Please note that returned items must be in their original condition
                                            and packaging to qualify for a refund or exchange. For more detailed
                                            information on our return policy, please refer to our dedicated Returns &
                                            Exchanges page.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="accordion">
                            <button type="button" id="accordion-toggle-03" class="accordion-toggle"
                                aria-controls="accordion-panel-03" aria-expanded="false">
                                <h2>Do you offer international shipping?</h2>
                                <span class="btn-icon" aria-hidden="true"></span>
                            </button>
                            <div id="accordion-panel-03" class="accordion-panel" aria-labelledby="accordion-toggle-03">
                                <!-- Additional div to smoothen grid 0 -> 1fr transition -->
                                <div class="accordion-drawer">
                                    <!-- Additional div to add padding to the content without messing with the animation -->
                                    <div class="content-container">
                                        <p>Yes, we do! At DS, we're delighted to serve customers worldwide and
                                            offer international shipping to most countries. Whether you're located
                                            across the globe or just a few borders away, you can enjoy our curated
                                            selection of products delivered right to your doorstep. Please note that
                                            shipping times and costs may vary depending on your location. For more
                                            information on international shipping rates and delivery estimates, feel
                                            free to reach out to our customer support team.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="accordion">
                            <button type="button" id="accordion-toggle-03" class="accordion-toggle"
                                aria-controls="accordion-panel-03" aria-expanded="false">
                                <h2>How can I contact customer support?</h2>
                                <span class="btn-icon" aria-hidden="true"></span>
                            </button>
                            <div id="accordion-panel-03" class="accordion-panel" aria-labelledby="accordion-toggle-03">
                                <!-- Additional div to smoothen grid 0 -> 1fr transition -->
                                <div class="accordion-drawer">
                                    <!-- Additional div to add padding to the content without messing with the animation -->
                                    <div class="content-container">
                                        <p>At DS, we're committed to providing exceptional customer service
                                            and assistance every step of the way. If you have any questions, concerns,
                                            or feedback regarding your shopping experience, our dedicated support team
                                            is here to help. You can reach us via email at support@d.com,
                                            through our website's live chat feature during business hours, or by filling
                                            out the contact form on our "Contact Us" page. We look forward to hearing
                                            from you and ensuring your DS experience exceeds your
                                            expectations. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>
</div>
<script>
const btns = document.querySelectorAll(".accordion-toggle");
const soloSwitch = document.getElementById("switch-toggle");
const soloStatus = document.getElementById("switch-status");

/* Internal state to store the last expanded panel. */
let lastActive = null;

/* Utils function */
const isPanelExpanded = (btn) => btn.getAttribute("aria-expanded") === "true";
const closePanel = (panel) => panel.setAttribute("aria-expanded", "false");

/* Use regular function declaration as callback for the event handler so the 'this' keyword can directly refers ti the btn element. */
function onButtonToggle() {
    const isSoloMode = soloSwitch.hasAttribute("checked");

    /* 1. In solo mode, collapse other expanded panels if any. */
    if (isSoloMode) {
        btns.forEach((btn) => {
            if (btn !== this && isPanelExpanded(btn)) {
                closePanel(btn);
            }
        });
    }

    /* 2. Expand/collapse selected panel by toggling attribute for the btn state (which trigger related panel visibility through CSS selector). */
    this.setAttribute("aria-expanded", `${!isPanelExpanded(this)}`);

    /* 3. Update internal state. */
    lastActive = this;
}

function onCheckboxToggle() {
    const isChecked = this.hasAttribute("checked");

    /* 1. Update UI for the toggle switch. */
    this.toggleAttribute("checked");

    /* 2. Update UI for the toggle switch status text. */
    soloStatus.innerText = isChecked ? "OFF" : " ON";

    /* 3. Close all expanded panel (if any) except the last active one. */
    btns.forEach((btn) => {
        if (btn !== lastActive && isPanelExpanded(btn)) {
            closePanel(btn);
        }
    });
}

soloSwitch.addEventListener("change", onCheckboxToggle);
btns.forEach((btn) => btn.addEventListener("click", onButtonToggle));
</script>
@endsection