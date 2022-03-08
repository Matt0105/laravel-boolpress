<template>
  <nav>
      <div class="container">
        <div class="logo-container">
            <img class="logo-img" :src="logo" alt="">
        </div>
        <ul class="link-list">
            <li v-for="link in linkList" :key="link.id"><a :href="link.link">{{link.label}}</a></li>
        </ul>
      </div>
  </nav>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            logo: require("../../img/logo.png"),
            linkList: [
                {
                    id: 1,
                    label: "Link 1",
                    link: "#"
                },
                {
                    id: 2,
                    label: "Link 2",
                    link: "#"
                },
                {
                    id: 3,
                    label: "Link 3",
                    link: "#"
                },
                {
                    id: 4,
                    label: "Link 4",
                    link: "#"
                },
            ]
        }
    }
}
</script>

<style lang="scss" scoped>

    nav {
        display: flex;
        align-items: center;
        justify-content: space-around;
        width: 100%;
        height: 70px;
        background-color: rgb(188, 216, 229);

        .logo-img {
            height: 60px;
        }

        .container {
            display: flex;
            align-items: center;


            .link-list {
                display: flex;
                list-style-type: none;
                margin: 0 auto;

                li {
                    padding: 0.5rem;

                    a {
                        color: black;
                        text-decoration: none;
                    }
                }
            }
        }
    }

</style>