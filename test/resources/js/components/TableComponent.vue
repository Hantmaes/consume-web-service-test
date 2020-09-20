<template>


<v-app id="app">
    
    <v-btn icon href="/data" >
            <v-spacer></v-spacer>
            <v-icon>arrow_back</v-icon>
    </v-btn>

    <v-data-table
    :headers="headers"
    :items="elements"
    sort-by="created_at"
    class="elevation-1"
    :items-per-page="3" 
    :footer-props="footerProps"
    @update:items-per-page="getItemPerPage"
    :search="search"
    >
    <template v-slot:top>
        <v-toolbar flat color="white">
            <v-toolbar-title>My List of Companies</v-toolbar-title>
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
        
                <v-card>
                <v-card-title>
                    <span class="headline">Detailed information</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                    <v-row>
                        <v-col cols="12">
                           
                            <v-text-field id="company" type="text" v-model="toData.ares_firma_fin" :disabled="!enabled" label="Company"></v-text-field>
                            <v-text-field id="address" type="text" v-model="toData.ares_ulice_fin" :disabled="!enabled" label="Address"></v-text-field>
                            <v-text-field id="city" type="text" v-model="toData.ares_mesto_fin" :disabled="!enabled" label="City"></v-text-field>
                            <v-text-field id="postcode" type="text" v-model="toData.ares_psc_fin" :disabled="!enabled" label="Postcode"></v-text-field>
                            <v-text-field id="ico" type="text" v-model="toData.ares_ico_fin" :disabled="!enabled" label="IČO"></v-text-field>
                            <v-text-field id="created" type="text" v-model="toData.created_at" :disabled="!enabled" label="Created at"></v-text-field>
                        
                            <v-subheader >Send this information to your administrator email<br>email: webtestinizio@gmail.com<br>password: Inizio2020</v-subheader>

                        </v-col>
                    </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="sendEmail">Send</v-btn>
                </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
        <v-icon
        big
        class="mr-2"
        @click="showItem(item)"
        >
        find_in_page
        </v-icon>

    </template>
    <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
    </v-data-table>
   
 </v-app>

</template>

<script>

export default {

        data: () => ({
            footerProps: {'items-per-page-options': [3, 6, 10]},
            drawer: null,
            dialog: false,
            enabled: false,
            search: '',
            
            
            headers: [

            { text: 'Company', align: 'start', value: 'ares_firma_fin' },
            // { text: 'Address', value: 'ares_ulice_fin', sortable: false },
            // { text: 'City', value: 'ares_mesto_fin', sortable: false },
            // { text: 'Postcode', value: 'ares_psc_fin', sortable: false },
            // { text: 'IČO', value: 'ares_ico_fin', sortable: false },
            { text: 'Created at', value: 'created_at' },
            { text: 'Actions', value: 'actions', sortable: false },
            ],
            elements: [],
            editedIndex: -1,
            toData: {
            ares_firma_fin: '',
            ares_ulice_fin: '',
            ares_mesto_fin: '',
            ares_psc_fin: '',
            ares_ico_fin: '',
            created_at: '',
            },
            defaultItem: {
            ares_firma_fin: '',
            ares_ulice_fin: '',
            ares_mesto_fin: '',
            ares_psc_fin: '',
            ares_ico_fin: '',
            created_at: '',
            },
        }),

        computed: {
 
        },

        watch: {
            dialog (val) {
            val || this.close()
            },
        },

        created () {
            this.initialize()
        },

        methods: {

            initialize () {
                fetch('/icos')
                    .then(res => res.json())
                    .then(res => {
                        this.elements = res.data;
                    })
                    .catch(err => console.log(err));
            
            },

            sendEmail: function(){
                const content = {
                    ares_firma_fin: this.toData.ares_firma_fin,
                    ares_ulice_fin: this.toData.ares_ulice_fin,
                    ares_mesto_fin: this.toData.ares_mesto_fin,
                    ares_psc_fin: this.toData.ares_psc_fin,
                    ares_ico_fin: this.toData.ares_ico_fin,
                    created_at: this.toData.created_at,

                }
                axios.post('/sendEmail', content).
                then(r => {
                    console.log(JSON.stringify(r.data, null, 2))
                    alert('Email sent!')
                }).catch(e => {
                    console.log(JSON.stringify(e, null, 2))
                    alert('error')
                })
                
                this.close()
                
            },

            showItem (item) {
            this.editedIndex = this.elements.indexOf(item)
            this.toData = Object.assign({}, item)
            this.dialog = true
            },

            close () {
            this.dialog = false
            this.$nextTick(() => {
                this.toData = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
            },

            getItemPerPage(val) {
                console.log(val);
            },
        },

}
</script>