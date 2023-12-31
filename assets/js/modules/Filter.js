/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLElement} sorting
 * @property {HTMLFormElement} form
 */

export default class Filter {
    /**
     * 
     * @param {HTMLElement|null} element 
     */
    constructor (element) {
        if (element === null) {
            return
        }
        this.pagination = element.querySelector('.js-filter-pagination')
        this.content = element.querySelector('.js-filter-content')
        this.sorting = element.querySelector('.js-filter-sorting')
        this.form = element.querySelector('.js-filter-form')
        this.bindEvents()
    }

    /**
     * Add behaviors to different elements
     */
    bindEvents () {
        this.sorting.addEventListener('click', e => {
            if (e.target.tagName === 'A') {
                e.preventDefault()
                this.loadUrl(e.target.getAttribute('href'))
            }
        })
        this.form.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this))
        })
    }

    async loadForm () {
        const data = new FormData(this.form)
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadUrl(url.pathname + '?' + params.toString())
    }

    async loadUrl (url) {
        const ajaxUrl = url + '&ajax=1'
        const response = await fetch(ajaxUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if (response.status >= 200 && response.status < 300) {
            const data = await response.json()
            this.content.innerHTML = data.content
            this.sorting.innerHTML = data.sorting
            history.replaceState({}, '', url)
        } else {
            console.error(response)
        }
    }

}
