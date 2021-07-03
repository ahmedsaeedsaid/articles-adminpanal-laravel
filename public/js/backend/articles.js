(function () {

    FTX.Articles = {

        list: {

            selectors: {
                articles_table: $('#articles-table'),
            },

            init: function () {

                this.selectors.articles_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.articles_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [

                        { data: 'name', name: 'articles.name' },
                        { data: 'publish_datetime', name: 'articles.publish_datetime' },
                        { data: 'display_status', name: 'articles.status' },
                        { data: 'created_by', name: 'articles.created_by' },
                        { data: 'created_at', name: 'articles.created_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }

                    ],
                    order: [[3, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            selectors: {
                categories: jQuery(".categories"),
                status: jQuery(".status"),
                publish_datetime: jQuery("#publish_datetime"),
            },

            init: function (locale) {
                this.addHandlers(locale);
                FTX.tinyMCE.init(locale);
            },

            addHandlers: function (locale) {

                this.selectors.tags.select2({
                    tags: true,
                    width: '100%',
                });

                this.selectors.categories.select2({
                    width: '100%',
                    tags: true,
                    placeholder: 'Select category'
                });

                this.selectors.status.select2({
                    width: '100%'
                });

                this.selectors.publish_datetime.datetimepicker({
                    locale: (locale === undefined ? 'en_US' : locale),
                });
            },
        },
    }
})();