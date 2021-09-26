 <template>

    <div class="container pt-3">
        <div class="card">
            <h5 class="card-header"> {{ post.title }} </h5>
            <!-- img  -->
            <div class="card-body">
                <h5 class="card-title cat" v-if="post.cat_id">
                    {{ post.category.name}} 
                </h5>                    
                <p class="card-text"> {{ post.content }}</p>

                <footer v-show="post.tags">
                    <div class="tags">
                        Tags:
                        <span v-for="tag in post.tags" :key="tag">{{tag.name}} </span>
                    </div>
                </footer>
            </div>
        </div>
        <router-link :to="{name: 'home'}" class="d-flex justify-content-end">
            <button class="btn btn-dark mt-3">Go back</button>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "Post",
    data() {
        return {
            post: []
        }
    },
    created(){
        this.getPost();
    },
    methods: {
        getPost() {
            axios.get('/api/post/'+ this.$route.params.slug)
            .then( response => {
                this.post = response.data.results;
                console.log(this.post);
                
            } )
            .catch(error => {
                console.log(error);
            });
        }
    }        
    
};
</script>

<style lang="scss" scoped>
</style>