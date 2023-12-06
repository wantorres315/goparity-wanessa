<script>

export default {
    name: 'amortization-list',

    created() {
    this.paginate()
    },

    data() {
    return {
        amortizations: {data: []},
        selectAll:false,
        selectedItems: [],
        searchQuery: '',
        apiUrl: '/api/amortizations/getAllPaid',
    }
    },

    methods: {
        async paginate(page = 1) {
            const {data: amortizations} = await axios.get(this.apiUrl, {
                params:{page}
            });
            this.amortizations = amortizations.data;
            const totalPages = amortizations.meta.last_page;
            this.currentPage = amortizations.meta.current_page;
            const pagesToShow = 5;
            const pagesArray = Array.from({ length: pagesToShow * 2 + 1 }, (_, index) => page - pagesToShow + index);
            this.pages = pagesArray.filter(currentPage => currentPage >= 1 && currentPage <= totalPages);
            this.totalPages = totalPages;
        },
        paid: function (id) {
            const urlApi = "/api/amortizations/paid/"+id;

            axios.get(urlApi)
            .then(response => {
                console.log('Resposta da API:', response.data);

                // Atualizar a propriedade "paid" para true para ocultar o botão e exibir o texto
                const index = this.amortizations.findIndex(item => item.id === id);
                if (index !== -1) {
                    this.amortizations[index].paid = true;
                    
                }
                
            })
            .catch(error => {
                console.error('Error to finish the payment:', error);
            });
            this.paginate(this.currentPage);
        },
        selectAllCheckboxes() {
            this.selectAll = !this.selectAll;
            if (this.selectAll) {
                this.$nextTick(() => {
                this.selectedItems = this.amortizations.map(item => item.id);

                });
            } else {
                this.selectedItems = [];
            }
        },
        searchMachine(){
            this.apiUrl = '/api/get_all_amortizations/'+this.searchQuery
            this.paginate();
        },
        sendSelectedItems() {
            if (this.selectedItems.length > 0) {
                const urlApiSelectedAll = '/api/amortizations/paid_batch'; 
                const data = { selectedItems: this.selectedItems };

                axios.post(urlApiSelectedAll, data)
                    .then(response => {
                        alert('Items paid successfully. Please wait a moment as your items are being processed.')
                        console.log('Response from Laravel:', response.data);
                    })
                    .catch(error => {
                        console.error('Error sending selected items:', error);
                    });
            } else {
                console.warn('No items selected.');
            }
        }
    }
}
</script>
<template>
    <div class="container">
        <div class="amortizations">
            <div class="card__header">
            <div>
                <h2 class="invoice__title">Paid Amortizations</h2>
            </div>
            <div>
                
                 <a class="btn btn-secondary" href="/" >
                    Back to Amortizations
                </a>
            </div>
        </div>
            <div class="table card__content">
                

                <div class="full-width">
                    <form>
                    <div class="table--search--select">
                        
                        <input  type="text" class="input" placeholder="Search amortization" v-model="searchQuery" @change="searchMachine">
                        
                    </div>
                </form>
                    
                       
                    
                </div>

                <div class="table--heading">
                    <p>
                        
                    </p>
                    <p>Project</p>
                    <p>User</p>
                    <p>Schedule Date</p>
                    
                    <p>Total</p>
                    <p>Actions</p>
                </div>

                <!-- item 1 -->
                <div class="table--items" v-for="item in amortizations" :key="item.id" v-if="amortizations.length > 0">
                    <p >
                        {{ item.id }}</p>
                    <p><a :href=item.url_project>{{ item.project.name }}</a></p>
                    <p>{{ item.user.name }}</p>
                    <p>{{ item.schedule_date}}</p>
                   
                    <p>{{ item.amount }}</p>
                    <p >Paid at {{ item.payment_created_at }}</p>
                   
                </div>
                <div class="table--items"  v-else>
                    No amortizations with this filter
                </div>
                
                <div class = 'paginations'  v-if="amortizations.length > 0">
                    <a class="paginationsItens " @click="paginate(1)">First</a>
                   
                    <div class="paginationsItens" v-for="(value) in pages" v-if="amortizations.length > 0">
                        <a  :class="{ 'active': currentPage == value }"  @click="paginate(value)">{{ value }}</a>
                    </div>
                    <a class="paginationsItens" @click="paginate(totalPages)">Last</a>
                </div>
               
            </div>
        
        </div>
    </div>
</template>
<style scoped>
div.paginations {
  display: flex;
  justify-content: center;

}
.paginationsItens{
    padding:15px;
    cursor:pointer;
}

</style>