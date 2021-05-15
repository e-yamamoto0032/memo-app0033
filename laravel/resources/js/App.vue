<template>
    <div>
        <header>
            <Navbar />
        </header>
        <main>
            <div class="container">
                <RouterView/>
            </div>
        </main>
    </div>
</template>
<script>
import Navbar from "./components/Navbar";

export default {
    components: {
        Navbar
    }
}
</script>
