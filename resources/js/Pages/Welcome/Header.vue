<template>

    <header class="sticky top-0 w-full">
        <div class="flex w-full bg-black h-full items-center text-white">

            <div v-if="canLogin" class="hidden sm:block ml-5">
                                <inertia-link v-if="$page.props.user" href="/dashboard" class="text-md  underline">
                                    Dashboard
                                </inertia-link>

                                <div v-else class="flex justify-end">
                                    <inertia-link :href="route('login')" class="p-1 text-md ml-4  underline">
                                        Log in
                                    </inertia-link>

                                    <inertia-link v-if="canRegister" :href="route('register')" class=" p-1 ml-4 text-md  underline">
                                        Register
                                    </inertia-link>
                                </div>
            </div>

            <form method="POST" v-if="authenticated" @submit.prevent="logout" class="ml-5">
                    <button>Log out</button>
            </form>

<!--  TOGGLE-->
            <div class="toggleColorTheme" @click="[toggleButtonRight = !toggleButtonRight, changeColorTheme()]">
                <div class="toggleButton" v-bind:class="{toggleButtonRight: toggleButtonRight}">
                </div>
            </div>

<!--  BURGER-->
            <div class="burger h-full cursor-pointer"
                 @click="burgerActive = !burgerActive"
            >
                <div class="layer a" v-bind:class="{layer1: burgerActive }"></div>
                <div id="layer2" class="layer a" v-bind:class="{layer2: burgerActive }"></div>
                <div id="layer3" class="layer" v-bind:class="{layer3: burgerActive }"></div>
            </div>
        </div>

    </header>
<!--  DROPDOWN  -->
    <div class="dropdownMenu shadow"
         v-bind:class="{dropdownMenuActive: burgerActive}"
    >
    </div>
</template>

<script>
export default {
    props: {
        authenticated: Boolean,
        canLogin:  Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    data () {
        return {
            burgerActive: false,
            toggleButtonRight: false,
            colorTheme: 'light'
        }
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
        changeColorTheme() {
            if(this.colorTheme == 'dark') {
                this.colorTheme = 'light';
            }
            else{
                this.colorTheme = 'dark';
            }
            this.$emit('colorThemeChanged', this.colorTheme);
        }
    },
    created() {

    }
}
</script>

<style>

.toggleColorTheme {
    height: 20px;
    width: 35px;
    background: white;
    margin-left: 10px;
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px;
    border-bottom-right-radius: 10px;
    border-top-right-radius: 10px;
    cursor: pointer;
    padding: 1px;
}
.toggleButton {
    position: relative;
    margin: 0;
    height: 98%;
    width: 20px;
    border-radius: 10px;
    background: #ecb03d;
    float: left;
    transition: 0.1s;
}
.toggleButtonRight {
    float: right;
}
 header {
     height: 36px;
     z-index: 999999;
 }

/*BURGER BUTTON */
.burger {
    position: fixed;
    right: 4%;
    top: 6px;
    width: 30px;
    height: 25px;
}
.layer {
    position: relative;
    top: 0;
    width: 100%;
    height: 3px;
    background: white;
    transition: 1s;
 }
.a {
    margin-bottom: 7px;
 }
.layer1 {
    transform: rotate(-45deg);
    top: 11px;
}
.layer2 {
    transform: translateX(100px);
    opacity: 0;
}
.layer3 {
    transform: rotate(45deg);
    top: -9px;
}

/*DROPDOWN MENU*/
.dropdownMenu {
    position: fixed;
    z-index: 3000;
    width: 300px;
    height: 500px;
    background: #FFFAF0;
    top: -500px;
    right: 40px;
    transition: 0.2s;
}

.dropdownMenuActive {
    top: 36px;
}

.shadow {
    box-shadow: 0px 0px 6px 0px #DCDCDC;
}
</style>
