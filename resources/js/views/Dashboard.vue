<template>
<div class="dashboard">
    <h1 class="subtitle-1 grey--text">Dashboard</h1>
    <v-container class="my-5">
        <v-row class="mb-3">
            <v-tooltip top>
                <template v-slot:activator="{ on }">
                    <v-btn small text color="grey" v-on="on" @click="sortBy('title')">
                        <v-icon left small>mdi-folder</v-icon>
                        <span class="caption text-lowercase">By project name</span>
                    </v-btn>
                </template>
                <span>Sort projects by project name</span>
            </v-tooltip>

            <v-tooltip top>
                <template v-slot:activator="{ on }">
                    <v-btn small text color="grey" @click="sortBy('person')" v-on="on">
                        <v-icon left small>mdi-account</v-icon>
                        <span class="caption text-lowercase">By person</span>
                    </v-btn>
                </template>
                <span>Sort projects by person name</span>
            </v-tooltip>

        </v-row>

        <v-card flat v-for="project in projects" :key="project.id">
            <v-row wrap :class="`pa-3 project ${project.status}`">
                <v-col cols="12" md="6">
                    <div class="caption grey--text">Project title</div>
                    <div>{{ project.title }}</div>
                </v-col>
                <v-col cols="6" sm="4" md="2">
                    <div class="caption grey--text">Person</div>
                    <div>{{ project.person}}</div>
                </v-col>
                <v-col cols="6" sm="4" md="2">
                    <div class="caption grey--text">Due by</div>
                    <div>{{ project.due }}</div>
                </v-col>
                <v-col cols="2" sm="4" md="2">
                    <div class="text-right">
                        <v-chip small :class="`${project.status} v-chip--active white--text caption my-2`">{{ project.status }}</v-chip>
                    </div>
                </v-col>
            </v-row>
            <v-divider></v-divider>
        </v-card>
    </v-container>
</div>
</template>

<script>
// import db from '../firebase'

export default {
    data() {
        return {
            projects: [{
                    title: 'Design a new website',
                    person: 'The Net Ninja',
                    due: '1st Jan 2019',
                    status: 'ongoing',
                    content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt consequuntur eos eligendi illum minima adipisci deleniti, dicta mollitia enim explicabo fugiat quidem ducimus praesentium voluptates porro molestias non sequi animi!'
                },
                {
                    title: 'Code up the homepage',
                    person: 'Chun Li',
                    due: '10th Jan 2019',
                    status: 'complete',
                    content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt consequuntur eos eligendi illum minima adipisci deleniti, dicta mollitia enim explicabo fugiat quidem ducimus praesentium voluptates porro molestias non sequi animi!'
                },
                {
                    title: 'Design video thumbnails',
                    person: 'Ryu',
                    due: '20th Dec 2018',
                    status: 'complete',
                    content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt consequuntur eos eligendi illum minima adipisci deleniti, dicta mollitia enim explicabo fugiat quidem ducimus praesentium voluptates porro molestias non sequi animi!'
                },
                {
                    title: 'Create a community forum',
                    person: 'Gouken',
                    due: '20th Oct 2018',
                    status: 'overdue',
                    content: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt consequuntur eos eligendi illum minima adipisci deleniti, dicta mollitia enim explicabo fugiat quidem ducimus praesentium voluptates porro molestias non sequi animi!'
                },
            ]
        }
    },
    methods: {
        sortBy(prop) {
            this.projects.sort((a, b) => a[prop] < b[prop] ? -1 : 1)
        }
    },
    created() {
        
    }
}
</script>

<style>
.project.complete {
    border-left: 4px solid #3cd1c2;
}

.project.ongoing {
    border-left: 4px solid orange;
}

.project.overdue {
    border-left: 4px solid tomato;
}

.v-chip.complete {
    background: #3cd1c2;
}

.v-chip.ongoing {
    background: #ffaa2c;
}

.v-chip.overdue {
    background: #f83e70;
}

.theme--light.v-chip:not(.v-chip--active) {
    background: #2600ff;
}
</style>
