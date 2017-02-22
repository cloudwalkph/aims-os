<template>
    <div class="container" id="app">
        <vue-html-editor name="html-editor" :model.sync="text"></vue-html-editor>
        <div style="margin-top:40px">
            <div> The HTML contents are as follows:</div>
            <hr>
            <div >{{{text}}}</div>
        </div>
    </div>
</template>

<script>
    var Vue = require("vue");

    var vm = new Vue({
        el: "#app",
        components: {
            "vue-html-editor": require("vue-html-editor")
        },
        data: {
            text: "Hello World!"
        }
    });
</script>