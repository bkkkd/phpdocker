var EditElementTypeProvider = (function() {
    return function(options) {

        var addElementTypes = function(context) {
            context.addPrintElementTypes(
                "normalPrint",
                [
                    new hiprint.PrintElementTypeGroup("常规", [{
                        tid: 'normalPrint.text',
                        text: '文本',
                        data: '文本',
                        type: 'text'
                    }, {
                        tid: 'normalPrint.image',
                        text: '图片',
                        data: '/static/admin/lib/hiprint/hi.png',
                        type: 'image'
                    }, {
                        tid: 'normalPrint.longText',
                        text: '长文',
                        data: '长文',
                        type: 'longText'
                    }, {
                        tid: 'normalPrint.tableCustom',
                        title: '自定义表格',
                        type: 'tableCustom',
                        editable: true,
                        columnDisplayEditable: true, //列显示是否能编辑
                        columnDisplayIndexEditable: true, //列顺序显示是否能编辑
                        columnTitleEditable: true, //列标题是否能编辑
                        columnResizable: true, //列宽是否能调整
                        columnAlignEditable: true, //列对齐是否调整
                        columns: [
                            [{
                                width: 100,
                                field: 'name',
                                title: '姓名'
                            }, {
                                width: 100,
                                field: 'age',
                                title: '年龄'
                            }]
                        ]
                    },{
                        tid: 'normalPrint.qrcode',
                        title: '二维码',
                        type: 'text',
                        "options": {
                                "title":"二维码",
                                "height": 50,
                                "width": 50,
                                "fontSize": 19,
                                "fontWeight": "700",
                                "textAlign": "center",
                                "lineHeight": 12,
                                "hideTitle": true,
                                "textType": "qrcode"
                            }
                    }, {
                        tid: 'normalPrint.barcode',
                        title:'条形码',
                        type: 'text',
                        "options": {
                                "title":"123123",
                                "height": 50,
                                "width": 150,
                                "fontSize": 19,
                                "fontWeight": "700",
                                "textAlign": "center",
                                "lineHeight": 39,
                                "textType": "barcode"
                            }
                            
                    }]),
                    new hiprint.PrintElementTypeGroup("辅助", [{
                        tid: 'normalPrint.hline',
                        text: '横线',
                        type: 'hline'
                    }, {
                        tid: 'normalPrint.vline',
                        text: '竖线',
                        type: 'vline'
                    }, {
                        tid: 'normalPrint.rect',
                        text: '矩形',
                        type: 'rect'
                    }, {
                        tid: 'normalPrint.oval',
                        text: '椭圆',
                        type: 'oval'
                    }])
   
                ]
            );
        };

        return {
            addElementTypes: addElementTypes
        };

    };
})();