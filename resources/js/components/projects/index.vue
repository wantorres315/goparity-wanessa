<script>

export default {
    name: 'amortization-list',
    props: ['projectId'],
    created() {
        this.getData(),
        this.paginate()
    },

    data() {
    return {
        project: {data: []},
        apiUrl: '/api/projects/'+this.projectId,
        apiUrlAddWallet : '/api/projects/project_add_value/'+this.projectId,
        wallet: 0,
    }
    },
    
    methods: {
        async paginate(page = 1) {
            const {data: amortizations} = await axios.get(this.apiUrlAmortization, {
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
        async getData() {
            const {data: project} = await axios.get(this.apiUrl);
            this.project = project.data;
           
        },
        async saveWallet() {
            try {
                // Assuming you want to send some data along with the POST request
                const postData = {
                    value: parseFloat(this.wallet)
                };

                // Making a POST request using Axios
                const response = await axios.post(this.apiUrlAddWallet, postData);
                this.project.wallet = response.data;
                console.log('Response from server:', response.data);


            } catch (error) {
                // Handle errors
                console.error('Error making POST request:', error);
            }
        },
        
    }
}
</script>
<template>
    <div class="container">
        <div class="amortizations">
                <div class="card__header">
                    <div>
                        <h2 class="invoice__title">Project: {{ project.name }} </h2>
                    </div>
                    
                </div>

                <div class="card__content p-100">
                    <div class="table__footer">
                        <div>
                            <p class="my-1">Add Value to Project</p>
                            <input id="project"  v-model="wallet" type="number" step="0.01" class="input">
                            <a class="btn btn-secondary"  @click="saveWallet">
                                Save 
                            </a>
                        </div>
                        <div>
                            <div class="table__footer--subtotal">
                                <p>Wallet</p>
                                <span id="value">$ {{project.wallet}}</span>
                            </div>
                            
                        </div>
                        <a class="btn btn-secondary "  href='/'>
                                Back to amortizations 
                            </a>
                    </div>
                </div>
            </div>
    </div>
</template>
