class SortOffersQueryParams {
    constructor() {
        this.sortSelect = document.getElementById('offer-sorting-select');
        this.searchForm = document.getElementById('offer-search-form')
        this.selectedHandle()
        this.events()
    }
    events = () => {


        this.sortSelect && this.sortSelect.addEventListener('change', (e) => {
            this.sortQueryChangeHandle(e.currentTarget.value)
        })
        this.searchForm && this.searchForm.addEventListener('submit', (e) => {
            [...e.currentTarget.elements].forEach(element => {
                if (element.value === '') {
                    element.name = ''
                }
            })
        })
    }
    selectedHandle = () => {
        const url = new URL(window.location)
        const params = new URLSearchParams(url.search)

        if (params.get('sort') && params.get('order')) {
            this.sortSelect.value = params.get('sort') + '|' + params.get('order')
        }


        if (this.sortSelect) {
            [...this.searchForm.elements].forEach(searchElement => {
                params.get('transaction_type') && searchElement.name == 'transaction_type' ? searchElement.value = params.get('transaction_type') : null
                params.get('property_type') && searchElement.name == 'property_type' ? searchElement.value = params.get('property_type') : null
                params.get('location') && searchElement.name == 'location' ? searchElement.value = params.get('location') : null
            })
        }

    }
    sortQueryChangeHandle = (sortQuery) => {
        const sortParams = sortQuery
        const sortParamsSplit = sortParams.split('|')
        if (sortParamsSplit.length === 2) {
            const sortBy = sortParamsSplit[0]
            const order = sortParamsSplit[1]
            const url = new URL(window.location)
            const params = new URLSearchParams(url.search)
            params.set('sort', sortBy)
            params.set('order', order)
            window.location.search = params.toString()
        }
    }
}
export default SortOffersQueryParams