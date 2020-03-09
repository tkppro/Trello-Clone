<template>
<div class="team">
    <h1 class="subtitle-1 grey--text">Team</h1>
    <v-container class="my-5">
        <v-row wrap>
            <v-col cols="12" sm="6" md="4" lg="3" v-for="person in team" :key="person.name">
                <v-card text class="text-center ma-3">
                    <v-responsive class="pt-4">
                        <v-avatar size="100" class="grey lighten-2">
                            <img :src="person.avatar" :alt="person.name">
                        </v-avatar>
                    </v-responsive>
                    <v-card-text>
                        <div class="title">{{ person.name }} </div>
                        <div class="grey--text">{{ person.role }} </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn text color="grey">
                            <v-icon small left>mdi-message</v-icon>
                            <span>Message</span>
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            team: [{
                    name: 'Thang Dang',
                    role: 'Web developer',
                    avatar: '/avatar.png'
                },
                {
                    name: 'Ryu',
                    role: 'Graphic designer',
                    avatar: '/avatar.png'
                },
                {
                    name: 'Chun Li',
                    role: 'Web developer',
                    avatar: '/avatar.png'
                },
                {
                    name: 'Gouken',
                    role: 'Social media maverick',
                    avatar: '/avatar.png'
                },
                {
                    name: 'Yoshi',
                    role: 'Sales guru',
                    avatar: '/avatar.png'
                }
            ]
        }
    }
}
</script>

<style>

</style>
