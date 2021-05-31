<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">シートの削除 (id:{{ delete_id }})</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span @click="$emit('close')">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    本当にこのシートを削除しますか？ (id:{{ id }})
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="deleteSheet">削除</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        delete_id: {
            type: Number,
        },
        user_id: {
            type: Number,
        },
    },
    data() {
        return {
            id: this.$props.delete_id,
        }

    },
    methods: {
        deleteSheet() {
            axios.delete('/api/sheets/' + this.id, {
                data:
                    {
                        id: this.id
                    }
            })
        }
    },
    computed: {
        userid() {
            return this.$store.getters['auth/userid']
        },
    }
}

</script>
