<template>
    <footer class="fly-footer">
        <div class="footer-contact">

        </div>
        <div class="footer-links">

        </div>
    </footer>
</template>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";
    @import "~bourbon/app/assets/stylesheets/bourbon";


    .fly-footer{
        @include position(relative,null 0 0 0);
        @include size(100% 300px);
        display: flex;
        .footer-contact{
            @include position(relative);
            @include size(500px 100%);
            background-color: $brand-primary;
            z-index: 1;
            &:before{
                @include position(absolute,0);
                @include size(100%);
                content: '';
                z-index: -1;
                background-color: inherit;
                transform-origin: bottom right;
                transform: sKewX(-20deg);
            }
        }
        .footer-links{
            @include position(relative);
            @include size(100%);
            background-color: $brand-accent;
        }

    }
</style>