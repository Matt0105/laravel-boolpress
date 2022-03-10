<template>
  <div>
      <div class="main-container" >
        <div class="total-card">
            <div class="preview">
                <div class="image-container">
                    <img v-if="postInfo.posts.image == null" :src="photoNull" alt="">
                    <img v-else :src='/storage/+postInfo.posts.image' alt="">
                </div>
                <div class="user">
                    <img class="userImg" :src=noUserPhoto alt="">
                    <span class="userName">{{getUser(postInfo.posts.user_id)}}</span>
                </div>
            </div>
            <div class="full-post">
                <label for="title">Title</label>
                <h1 class="title">{{postInfo.posts.title}}</h1>
                <div class="paragraph-container">
                    <p>{{postInfo.posts.content}}</p>
                </div>
                <div class="tags">
                <label for="tags">Tags</label>
                <span class="tag-badge" v-for="tag in getTags(postInfo.posts)" :key="tag.id">{{tag}}</span>
                </div>
                <div class="category-container">
                <label for="category">Category</label>
                <span class="category">{{getCategory(postInfo.posts.category_id)}}</span>
                </div>
            </div>
        </div>
      </div>
  </div>
</template>

<script>

import Main from "../components/Main.vue";

export default {
    name: "Post",
    components: {
        Main,
    },
    props: ["id"],
    data() {
        return {
            photoNull: require("../../img/no-image-available.jpeg"),
            noUserPhoto: require("../../img/no-photo.jpeg"),
            postInfo: {
                
                posts: [],
                users: [],
                categories: [],
                tags: [],
                nextPage: "",
                prevPage: ""
                
            }
            // posts: []
        }
    },
    created() {
        //faccio la chiamata all'api e popolo tutte le info, con anche user, category, tags e pagine prev e next
        axios.get("http://127.0.0.1:8000/api/posts/" + this.id)
            .then(res => {
                console.log(res);
                this.postInfo.posts = res.data.resultsPosts.data;
                this.postInfo.users = res.data.resultsUsers;
                this.postInfo.categories = res.data.resultsCategories;
                this.postInfo.tags = res.data.resultsTags;

                this.postInfo.nextPage = res.data.resultsPosts.next_page_url;
                this.postInfo.prevPage = res.data.resultsPosts.prev_page_url;
                console.log(this.postInfo.posts);
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        getUser(postUserId) {
            let user;
            this.postInfo.users.map(el => {
                if(el.id === postUserId) {
                    user = el.name;
                }
            })

            return user;
       
        },
        getCategory(postCategoryId) {
            let category;
            this.postInfo.categories.map(el => {
                if(el.id === postCategoryId) {
                    category = el.name;
                }
            })

            return category;
        },
        getTags(post) {
            let postTags = [];

            for(let i = 0; i < this.postInfo.tags.length; i++) {
                for(let y = 0; y < this.postInfo.tags[i].posts.length; y++) {
                    if(this.postInfo.tags[i].posts[y].id == post.id) {
                        postTags.push(this.postInfo.tags[i].name);
                        y = this.postInfo.tags[i].posts.length;
                    }
                }
            }
            return postTags;

        },
    }
}
</script>

<style lang="scss" scoped>

    .main-container {
        background-image: url("../../img/bckg.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;

    }

    .container {
        padding: 1rem;
    }

    .changePage-container {
        text-align: center;

        .btn {
            background-color: rgb(42, 167, 240);
            border: 1px solid white;
            color: white;
            margin: 0.5rem;
        }
    }

    .total-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 80%;
        height: 400px;
        background-color: transparent;
        margin: 1rem auto;
        transition: all 0.5s;
        cursor: pointer;


        .preview {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40%;
            height: 100%;
            background-color: white;
            transition: all 0.5s;
            box-shadow: 1px 1px 8px rgba(0,0,0,0.5);


            .image-container {
                width: 100%;
                height: 300px;

                img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }
            }

            .user {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                margin-top: 1rem;

                img {
                    width: 15%;
                }

                .userName {
                    font-weight: bold;
                    font-size: 1.5rem;
                    margin-left: 1rem;
                }
            }
        }

        .full-post {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            width: 60%;
            height: 350px;
            padding: 1rem;
            background-color: rgb(42, 167, 240);
            overflow: hidden;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.8);
            color: white;

            transition: all 0.8s;

            .paragraph-container {
                max-height: 180px;
                overflow: hidden;
                align-self: flex-start;
            }

            label {
                display: block;
                text-transform: uppercase;
                text-align: center;
                font-weight: bold;
                font-size: 0.9rem;
                color: rgba(255,255,255,0.7);
            }

            .title {
                font-size: 2rem;
            }

            .tags {
                position: absolute;
                left: 20px;
                bottom: 10px;

                .tag-badge {
                    border: 2px solid white;
                    font-size: 0.7rem;
                    text-transform: uppercase;
                    margin-right: 0.5rem;
                    padding: 0.2rem 0.3rem;
                    cursor: pointer;
                    transition: all 0.2s;

                    &:hover {
                        color: rgb(42, 167, 240);
                        background-color: white;;
                    }
                }
            }

            .category-container {
                position: absolute;
                display: flex;
                flex-direction: column;
                align-items: center;
                right: 30px;
                bottom: 10px;
            }
        }

    }
</style>