<template>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="https://canada.uptake.com/portals/0/Images/Icons/CustomerManagement.png" height="35">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link :to="{ name: 'subscribers'}" class="nav-link">
                                Subscribers
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'fields'}" class="nav-link">
                                Fields
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from 'vue-class-component'

    @Component
    export default class Navigation extends Vue {
        drawer: boolean = false;
    }
</script>

<style>
    .navbar-dark .navbar-nav .nav-link {
        color: #fff;
        font-size: 1rem;
    }
</style>
