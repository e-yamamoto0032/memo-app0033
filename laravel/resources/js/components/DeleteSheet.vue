<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">シートの削除</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    本当にこのシートを削除しますか？
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
            required: true
        },
        user_id: {
            type: Number,
            required: true
        },
    },
    methods: {
        deleteSheet() {
            if(this.user_id === this.userid) {
                axios.delete('/api/sheets/' + this.delete_id, {
                    data:
                        {
                            id: this.delete_id
                        }
                })
                    .then(() => {
                    location.reload()
                })
            }else {
                location.href = '/'
            }
        }
    },
    computed: {
        userid() {
            return this.$store.getters['auth/userid']
        },
    }
}

</script>
