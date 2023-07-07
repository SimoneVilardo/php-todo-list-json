const { createApp } = Vue;

createApp({
    data() {
        return {
            // inizializziamo le variabili vuote
            todoItem: '', // elemento da aggiungere alla lista
            todoList: [], // lista degli elementi
            apiUrl: 'server.php' // URL dell'API per recuperare e aggiornare i dati
        }
    },

    mounted() {
        // chiamata axios per recuperare i dati
        axios.get(this.apiUrl).then((response) => {
            this.todoList = response.data; // assegna i dati della risposta alla lista degli elementi
        });
    },

    methods: {
        // funzione per aggiungere un elemento alla lista
        updateList() {
            const data = {
                todoItem: this.todoItem // oggetto contenente l'elemento da aggiungere
            }

            axios.post(this.apiUrl, data, {
                headers: { 'Content-Type': 'multipart/form-data' }
            }).then((response) => {
                this.todoItem = ''; // resetta l'elemento da aggiungere
                this.todoList = response.data; // assegna i dati della risposta alla lista aggiornata
            });
        },
        // cambia item
        toggle(index) {
            const data = new FormData();
            data.append('updateTaskIndex', index);

            axios.post(this.apiUrl, data).then((response) => {
                this.todoList = response.data;
            });
        },

        // elimina item
        deleteItem(index) {
            const data = new FormData();
            data.append('deleteItemIndex', index);

            axios.post(this.apiUrl, data).then((response) => {
                this.todoList = response.data;
            });
        }

    },
}).mount('#app');