<template>


<!--        <div class="flex text-right bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">-->
<!--            <div v-if="canLogin" class="hidden top-0 right-0 px-6 py-4 sm:block">-->
<!--                <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">-->
<!--                    Dashboard-->
<!--                </inertia-link>-->

<!--                <div v-else class="flex justify-end">-->
<!--                    <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">-->
<!--                        Log in-->
<!--                    </inertia-link>-->

<!--                    <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">-->
<!--                        Register-->
<!--                    </inertia-link>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<div v-bind:class="{dark: Theme.colorTheme}">
    <div class="h-screen bg-gray-900 dark:bg-gray-100">
        <!-- HEADER -->
        <header-app :canLogin="canLogin" :canRegister="canRegister" :authenticated="authenticated"
            @colorThemeChanged="toggleTheme($event)"
        ></header-app>
        <!-- LEFT BUTTON -->
        <div class="fixed left-circle cursor-pointer shadow" id="leftButton"
             v-bind:class="{leftButtonActive: leftBlockActive}"
             @click="leftBlockActive = !leftBlockActive"
             v-show="display < 768" >
            <font-awesome-icon class="chart-icon"
                icon="chart-bar" size="2x"
            />
        </div>
        <!-- RIGHT BUTTON -->
        <div class="fixed right-circle cursor-pointer shadow" id="rightButton"
             v-bind:class="{rightButtonActive: rightBlockActive}"
             @click="rightBlockActive = !rightBlockActive"
             v-show="display < 992" >
            <font-awesome-icon class="chat-icon"
                icon="comments"  size="2x"
            />
        </div>
        <!-- CONTENT -->
        <div class="content main flex w-full justify-center pb-5">
            <!-- LEFT BLOCK -->
            <div id="leftBlock" class="flex shadow-xl mt-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-black"
                v-bind:class="{leftMenuActive: leftBlockActive}"
            >
                <div class="flex flex-col w-full ">
                    <div class="flex p-2 w-full h-1/2 border-blue-600 dark:border-opacity-0 rounded border-2">
                        <wallets-app></wallets-app>
                    </div>
                    <div class="flex p-2 w-full h-1/2 border-blue-600 dark:border-opacity-0 rounded border-2">
                        <market-app></market-app>
                    </div>
                </div>
            </div>
            <!-- CENTRAL BLOCK -->

            <div id="middleBlock" class="p-4 shadow-xl flex flex-col w-full h-auto overflow-scroll m-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-black rounded">
                <div class="p-2 flex w-full border-blue-600 border-2 dark:border-opacity-0" style="height: 500px;">
                    <exchange-app></exchange-app>
                </div>
                <div class="flex sm2:flex-row smxx:flex-col p-2 w-full h-96 border-blue-600 dark:border-opacity-0 border-2" style="height: 500px;">
                    <trade-currency-app></trade-currency-app>
                </div>
                <div class="flex sm2:flex-row smxx:flex-col p-2 w-full h-96 border-blue-600 dark:border-opacity-0 border-2" style="height: 500px;">
                    <trade-order-app></trade-order-app>
                </div>
            </div>

            <!-- RIGHT BLOCK -->
            <div id="rightBlock" class="mt-2 border-blue-600 dark:border-gray-200 bg-gray-800 dark:bg-gray-200 border-2 rounded"
                 v-bind:class="{rightMenuActive: rightBlockActive}"
            >
                <chat-app :authenticated="authenticated" class="h-full shadow-xl"></chat-app>
            </div>
        </div>
    </div>
</div>

</template>

<script>

import Header from './Welcome/Header.vue'
import Wallets from './Welcome/Wallets.vue'
import Market from './Welcome/Market.vue'
import Exchange from './Welcome/Exchange.vue'
import TradeCurrency from './Welcome/TradeCurrency.vue'
import TradeOrder from './Welcome/TradeOrder.vue'
import Chat from './Welcome/Chat.vue'
import Button from "@/Jetstream/Button";
import { useRemember } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Button,
        headerApp: Header,
        walletsApp: Wallets,
        marketApp: Market,
        exchangeApp: Exchange,
        tradeCurrencyApp: TradeCurrency,
        tradeOrderApp: TradeOrder,
        chatApp: Chat
    },
    props: {
        authenticated: Boolean,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    setup() {
      const Theme = useRemember({
          colorTheme: false
      })
        return {Theme};
    },
    data() {
        return {
            display: window.innerWidth,
            rightBlockActive: false,
            leftBlockActive: false,

        }
    },
    methods: {
        onResize() {
            this.display = window.innerWidth
        },
        toggleTheme($event) {
            if($event == 'dark') {
                this.Theme.colorTheme = true;
                console.log('colorTheme - dark');
            }
            else {
                this.Theme.colorTheme = false;
                console.log('colorTheme - light');
            }
        }
    },
    created() {
        window.addEventListener('resize', this.onResize)
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.onResize)
    },
}

</script>

<style>

.dark {

}
.content {
    height: 94%;
    margin-left: auto;
    margin-right: auto ;
}

#middleBlock::-webkit-scrollbar {
    width: 0;
}

#leftButton, #leftBlock {
    z-index: 100;
}
#middleBlock {
    z-index: 0;
}

#rightButton, #rightBlock {
    z-index: 2000;
}

.left-circle {
    bottom: 49%;
    width: 50px;
    height: 50px;
    border: 1px solid;
    border-top-right-radius: 25px;
    border-bottom-right-radius: 25px;
    background: black;
    opacity: 0.5;
}
.chart-icon {
    margin-top: 7px;
    margin-left: 4px;
    color: white;
}

.right-circle {
    right: -3px;
    bottom: 49%;
    width: 50px;
    height: 50px;
    border: 1px solid;
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
    background: black;
    opacity: 0.5;
}

.chat-icon {
    margin-top: 7px;
    margin-left: 7px;
    color: white;
}

.left-circle.shadow {
    box-shadow: 0px 0px 60px 10px #0c0e0c;
}
.right-circle.shadow {
    box-shadow: 0px 0px 60px 10px #0c0e0c;
}

@media (min-width: 992px) {

    #leftBlock {
        width: 25%;
    }
    #middleBlock {
        width: 50%;
    }
    #rightBlock {
        width: 25%;
    }
}

@media (min-width: 768px) and (max-width: 991px)
{
    #leftBlock {
        width: 33%;
    }
    #middleBlock {
        width: 67%;
    }
    #rightBlock {
        position: fixed;
        right: -41%;
        width: 41%;
        height: 90%;
        transition: 1s;
    }
    .rightMenuActive {
        right: 0 !important;
    }
    #rightButton {
        right: 0;
        bottom: 50%;
        transition: 1s;
    }
    .rightButtonActive {
        right: 41% !important;
    }
}

@media (max-width: 767px)  {
    #leftBlock {
        position: fixed;
        width: 41%;
        left: -41%;
        height: 100%;
        transition: 1s;
    }
    .leftMenuActive {
        left: 0 !important;
    }
    #leftButton {
        left: 0;
        bottom: 50%;
        transition: 1s;
    }
    .leftButtonActive {
        left: 41% !important;
    }
    #middleBlock {
        width: 100%;
    }
    #rightBlock {
        position: fixed;
        right: -41%;
        width: 41%;
        height: calc(100% - 55px);
        transition: 1s;
    }
    .rightMenuActive {
        right: 0 !important;
    }
    #rightButton {
        right: 0;
        bottom: 50%;
        transition: 1s;
    }
    .rightButtonActive {
        right: 41% !important;
    }
}

@media (max-width: 510px){
    #leftBlock {
        width: 49%;
        left: -49%;
    }
    #rightBlock {
        width: 49%;
        right: -49%;
    }
    .rightButtonActive {
        right: 49% !important;

    }
    .leftButtonActive {
        left: 49% !important;
    }
}

@media (min-width: 1600px) {
    .main {
        max-width: 1270px;
    }
}
@media (min-width: 1200px) {
    .main {
        max-width: 1200px;
    }
}
@media (min-width: 992px) {
    .container {
        max-width: 992px;
    }
}
@media (min-width: 768px) {
    .container {
        max-width: 768px;
    }
}
@media (min-width: 576px) {
    .container {
        max-width: 576px;
    }
}

</style>
