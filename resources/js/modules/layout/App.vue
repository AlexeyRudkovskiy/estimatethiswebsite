<template>
<div>
    <div class="inline">
        <router-link :to="{ name: 'home' }" class="button button-default"><span class="material-icons">add</span> Home</router-link>
        <router-link :to="{ name: 'second' }" class="button button-success">Second Page</router-link>
        <a href="javascript:" class="button button-danger">Danger Button!</a>
    </div>

    <div class="inline">
        <a href="javascript:" class="button button-small button-default">hello world</a>
        <a href="javascript:" class="button button-small button-danger">hello world</a>
        <a href="javascript:" class="button button-small button-success"><span class="material-icons">add</span> hello world</a>
    </div>

    <div class="inline">
        <a href="javascript:" class="button button-link button-small button-default">hello world</a>
        <a href="javascript:" class="button button-link button-small button-danger">hello world</a>
        <a href="javascript:" class="button button-link button-small button-success"><span class="material-icons">add</span> hello world</a>
    </div>

    <router-view></router-view>
</div>
</template>

<script>
export default {
    name: "App"
}
</script>

<style scoped>
    .inline {
        display: flex;
        align-items: center;
    }

    .inline a:not(:first-child) {
        margin-left: 10px;
    }
</style>
