<template>
    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">&copy; 2019</span>
        </div>
    </footer>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from 'vue-class-component'

    // The @Component decorator indicates the class is a Vue component
    @Component
    export default class Footer extends Vue {

    }
</script>
