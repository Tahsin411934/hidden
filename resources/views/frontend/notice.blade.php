<style>
    .marquee-container {
        overflow: hidden;
        position: relative;
        color: #92400E;
        
        display: flex;
        width: 90%;
        margin: 0 auto;
        align-items: center;
    }

    .notice-text {
        flex-shrink: 0;
        background-color: #F37021;
        color: white;
        padding: 0 1rem;
        height: 100%;
        display: none; /* Hidden by default */
        align-items: center;
        font-weight: bold;
        z-index: 10;
    }

    .marquee-wrapper {
        position: relative;
        overflow: hidden;
        flex-grow: 1;
    }

    .marquee-text {
        display: inline-block;
        white-space: nowrap;
        will-change: transform;
        animation: marquee 25s linear infinite;
        font-weight: 600;
        padding-left: 1rem;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    /* Show notice text on lg screens and above */
    @media (min-width: 1024px) {
        .notice-text {
            display: flex;
        }
        .marquee-text {
            padding-left: 1rem;
        }
    }

    /* Remove left padding on small screens when notice is hidden */
    @media (max-width: 1023px) {
        .marquee-text {
            padding-left: 0;
        }
    }
</style>

<div class="border-b border-[#92400E] mb-[2px]">
    <div class="marquee-container lg:h-11 text-sm w-[90%] mx-auto">
        <div class="notice-text">
            📢 Notice
        </div>
        <div class="marquee-wrapper">
            <span class="marquee-text">
                শাখা অনুমোদন ২০২৫ : দেশ জুড়ে আঞ্চলিক শাখা অনুমোদন চলছে, আপনার কম্পিউটার ট্রেনিং ব্যবসাকে পরিকল্পিতভাবে প্রসারিত করতে আপনিও যুক্ত হতে পারেন আমাদের সাথে। আমরা আছি দেশ জুড়ে, দক্ষ জনবল সৃষ্টির লক্ষ্যে।
            </span>
        </div>
    </div>
</div>