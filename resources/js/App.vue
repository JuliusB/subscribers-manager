<template>
    <div>
        <Navigation></Navigation>
        <main role="main" class="flex-shrink-0">
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
        <Footer></Footer>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from 'vue-class-component'
    import Footer from './components/Footer'
    import Navigation from './components/Navigation'

    @Component({
        components: {
            Footer, Navigation
        }
    })
    export default class App extends Vue {

    }
</script>
