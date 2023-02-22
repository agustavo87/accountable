export default (opts) => ({
    open: opts.entangles.open,
    show () {
        this.open = true;
        this.$nextTick(() => this.$refs.categoryName.focus())
        
    },
    close () {
        this.open = false
    },
    cancel() {
        this.$wire.call('cancel')
    }
})