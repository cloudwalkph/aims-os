<template>
    <div class="jo-slick col-lg-12 col-sm-12 col-xs-12 col-md-12">
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
    </div>
</template>

<script>
    export default {
        mounted() {
            $('.jo-slick').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
        }
    }
</script>
