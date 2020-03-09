<template>
<nav>
    <!-- <v-snackbar v-model="snackbar" :timeout="4000" top color="success">
        <span>Project added!</span>
        <v-btn text color="white" @click="snackbar = false">Close</v-btn>
    </v-snackbar> -->

    <v-snackbar v-model="snackbar" :timeout="4000" top color="success">
        <span>Task added!</span>
        <v-btn text color="white" @click="snackbar(false)">Close</v-btn>
    </v-snackbar>

    <v-app-bar app text>
        <v-app-bar-nav-icon class="grey--text" @click="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title class="text=uppercase grey--text">
            <span class="font-weight-light">Trello</span>
            <span>Laravel</span>
        </v-toolbar-title>
        <v-spacer></v-spacer>

        <!-- Dropdown menus -->
        <v-menu offset-y v-if="loggedIn">
            <template v-slot:activator="{ on }">
                <v-btn text v-on="on" color="grey">
                    <v-icon left>mdi-chevron-down</v-icon>
                    <span>Menu</span>
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="link in links" :key="link.text" :to="link.route">
                    <v-list-item-title>{{ link.text }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
        <!--  -->
        <v-menu offset-y v-if="!loggedIn">
            <template v-slot:activator="{ on }">
                <v-btn text v-on="on" color="grey">
                    <v-icon left>mdi-chevron-down</v-icon>
                    <span>Menu</span>
                </v-btn>
            </template>
            <v-list>
                <v-list-item router :to="{name: 'login'}">
                    <v-list-item-content>
                        <v-list-item-title text color="grey">Login</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item router :to="{ name: 'register' }">
                    <v-list-item-content>
                        <v-list-item-title text color="grey">Register</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

            </v-list>
        </v-menu>

        <v-btn text color="grey" v-if="loggedIn" router :to="{ name: 'logout' }">
            <span>Log Out</span>
            <v-icon color="grey darken-3">mdi-logout</v-icon>
        </v-btn>
    </v-app-bar>
    <v-navigation-drawer v-if="loggedIn" app class="primary" v-model="drawer">
        <v-row justify="center">
            <v-col cols="6" class="mt-5">
                <v-avatar size="100">
                    <img src="/avatar.png" alt="Avatar">
                </v-avatar>
                <p class="text-center white--text title mt-1">{{ name }}</p>
            </v-col>
            <v-col class="mt-4 mb-3">
                <Popup @projectAdded="snackbar = true" />
            </v-col>
        </v-row>
        <v-list>
            <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
                <v-list-item-icon>
                    <v-icon class="white--text">{{ link.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title class="white--text">{{ link.text }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</nav>
</template>

<script>
import Popup from './Popup'

export default {
    components: {
        Popup
    },
    data() {
        return {
            drawer: false,
            links: [{
                    icon: 'mdi-view-dashboard',
                    text: 'Dashboard',
                    route: '/'
                },
                {
                    icon: 'mdi-view-dashboard',
                    text: 'Table',
                    route: '/table'
                },
                {
                    icon: 'mdi-folder',
                    text: 'My Projects',
                    route: '/projects'
                },
                {
                    icon: 'mdi-account',
                    text: 'Team',
                    route: '/team'
                },
            ],
            
            
        }
    },
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn
        },
        name() {
            return this.$store.getters.name
        },
        snackbar: {
            get() {
                return this.$store.getters.getIsTaskAdded
            },
            set(value) {
                this.$store.state.isTaskAdded = value
            }

        }
    },
}
</script>

<style>

</style>
