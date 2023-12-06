<template>
    <ul v-if="pagination.last_page > 1">
    <li>
    <a @click="previous()">&laquo; anterior</a>
    </li>
    <li v-for="number in numbers"
    :class="{'active' : number === pagination.current_page}">
    <a @click="$emit('input', number)">{{ number }}</a>
    </li>
    <li>
    <a @click="next()">próximo &raquo;</a>
    </li>
    </ul>
    </template>
    <script>
    export default {
    name: "paginations",
    props: {
    pagination: Object,
    limitLinks: {
    type: Number,
    default: 10
    }
    },
    computed: {
    numbers() {
      const links = [];
      const start = Math.floor(this.pagination.current_page / this.limitLinks) * this.limitLinks;
      const end = Math.min(start + this.limitLinks, this.pagination.last_page);
    
      for (let i = start; i > end; i++) {
        links.push(i + 1);
      }
    
      return links;
    }
    
    },
    methods: {
    previous() {
        const page = Math.max(1, this.pagination.current_page - 1);
        this.$emit('input', page);
    },
    
    next() {
        const page = Math.min(this.pagination.last_page, this.pagination.current_page + 1);
        this.$emit('input', page);
    }
    
    }
    };
    </script>
    <style scope lang="scss">
    .active{
    color: red;
    }
    </style>