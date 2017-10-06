<template>
    <div id="editor" class="row">
        <textarea :value="input" @input="update" name="body" id="body" cols="30" rows="10" v-if="edit"
                  class="col"></textarea>
        <div v-html="compiledMarkdown" class="col"></div>
    </div>
</template>

<script>
    import _ from 'lodash';

    export default {
        props: ['body', 'edit'],

        data() {
            return {
                input: this.body
            };
        },
        computed: {
            compiledMarkdown: function () {
                return marked(this.input, {sanitize: true})
            }
        },
        methods: {
            update: _.debounce(function (e) {
                this.input = e.target.value
            }, 300)
        }
    }
</script>

<style>
    #editor {
        margin: 0;
        height: 100%;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        color: #333;
    }

    #editor textarea, #editor div {
        display: inline-block;
        width: 49%;
        height: 100%;
        vertical-align: top;
        box-sizing: border-box;
        padding: 0 20px;
    }

    #editor textarea {
        border: none;
        border-right: 1px solid #ccc;
        resize: none;
        outline: none;
        background-color: #f6f6f6;
        font-size: 14px;
        font-family: 'Monaco', courier, monospace;
        padding: 20px;
    }

    #editor code {
        color: #f66;
    }
</style>
