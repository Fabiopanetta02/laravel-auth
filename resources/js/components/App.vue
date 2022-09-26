<template>
    <div class="content">
        <Placeholder :title="title"/>
    </div>
</template>

<script>
import Placeholder from "./Placeholder" 
export default {
    name: "App",
    components: { 
        Placeholder 
    },
    data(){
        return {
            title:"Coming Soon....",
        };
    },
};
</script>

<style>

</style>