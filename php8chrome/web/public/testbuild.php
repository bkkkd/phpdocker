<?php
include '../global.php';

if(!APP_DEBUG){
    exit;
}
$json=<<<EOT
{
        "template": {
            "panels": [
                {
                    "height": 297,
                    "width": 210,
                    "paperHeader": 61.5,
                    "paperFooter": 790,
                    "printElements": [
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 100.5,
                                "top": 6,
                                "height": 22.5,
                                "width": 193.5,
                                "title": "\u4f5b\u5c71\u5e02\u827e\u51ef\u63a7\u80a1\u96c6\u56e2\u6709\u9650\u516c\u53f8 ",
                                "fontSize": 14.25,
                                "fontWeight": "bolder",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 363,
                                "top": 7.5,
                                "height": 9.75,
                                "width": 220.5,
                                "title": "\u5730\u5740: \u5e7f\u4e1c\u7701\u4f5b\u5c71\u5e02\u987a\u5fb7\u533a\u4f26\u6559\u5f85\u9053\u7f8a\u989d\u6751\u73cd\u73e0\u8def3\u53f7"
                            }
                        },
                        {
                            "tid": "normalPrint.image",
                            "options": {
                                "left": 13.5,
                                "top": 9,
                                "height": 22.5,
                                "width": 75,
                                "src": "https:\/\/plm.dev.alpicool.com\/static\/index\/images\/alpicool.png"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 363,
                                "top": 22.5,
                                "height": 9.75,
                                "width": 120,
                                "title": "\u7f51\u5740: www.alpicool.com"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 249,
                                "top": 33,
                                "height": 25.5,
                                "width": 102,
                                "title": "\u6837\u54c1\u8ba4\u8bc1\u4e66",
                                "fontSize": 19.5,
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 363,
                                "top": 37.5,
                                "height": 9.75,
                                "width": 120,
                                "title": "\u7535\u8bdd: 0757-23628780"
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 288,
                                "top": 60,
                                "height": 90,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 66,
                                "top": 61.5,
                                "height": 286.5,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 475.5,
                                "top": 61.5,
                                "height": 57,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.rect",
                            "options": {
                                "left": 3,
                                "top": 61.5,
                                "height": 286.5,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 391.5,
                                "top": 63,
                                "height": 55.5,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 294,
                                "top": 64.5,
                                "height": 21,
                                "width": 94.5,
                                "field": "audit_time",
                                "testData": "2024\u5e7410\u670820\u65e5",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 189,
                                "top": 64.5,
                                "height": 85.5,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 193.5,
                                "top": 66,
                                "height": 18,
                                "width": 49.5,
                                "title": "\u53d1\u6587\u65e5\u671f",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 66,
                                "height": 18,
                                "width": 102,
                                "field": "info_code",
                                "testData": "FBS20241010001",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 397.5,
                                "top": 66,
                                "height": 18,
                                "width": 64.5,
                                "title": "\u662f\u5426\u914d\u9001\u6837\u54c1",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 66,
                                "height": 18,
                                "width": 55.5,
                                "title": "\u53d1\u6587\u7f16\u53f7",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 483,
                                "top": 66,
                                "height": 18,
                                "width": 99,
                                "field": "deliverySampleTypeName",
                                "testData": "\u662f",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 88.5,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 294,
                                "top": 93,
                                "height": 21,
                                "width": 94.5,
                                "field": "model",
                                "testData": "TW001",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 91.5,
                                "height": 25.5,
                                "width": 111,
                                "field": "recycle_info_code",
                                "testData": "FBS20241010000",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 483,
                                "top": 93,
                                "height": 21,
                                "width": 99,
                                "field": "supply_start",
                                "testData": "2024\u5e7408\u670822\u65e5",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 91.5,
                                "height": 22.5,
                                "width": 55.5,
                                "title": "\u56de\u6536\u6587\u4ef6",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 193.5,
                                "top": 93,
                                "height": 22.5,
                                "width": 66,
                                "title": "\u4f7f\u7528\u673a\u578b",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 397.5,
                                "top": 93,
                                "height": 21,
                                "width": 78,
                                "title": "\u7269\u6599\u65e5\u671f",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 118.5,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 193.5,
                                "top": 121.5,
                                "height": 27,
                                "width": 85.5,
                                "title": "\u7269\u6599\u540d\u79f0",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 121.5,
                                "height": 25.5,
                                "width": 55.5,
                                "title": "\u7269\u6599\u7f16\u7801",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 294,
                                "top": 121.5,
                                "height": 25.5,
                                "width": 288,
                                "field": "materialName",
                                "testData": "C50+APP\u8f66\u5bb6\u4e24\u7528\u51b0\u7bb1\u9ed1(alpicool)",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 123,
                                "height": 25.5,
                                "width": 111,
                                "field": "materialNumber",
                                "testData": "A01001",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 150,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 153,
                                "height": 24,
                                "width": 55.5,
                                "title": "\u89c4\u683c\u578b\u53f7",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 154.5,
                                "height": 22.5,
                                "width": 508.5,
                                "field": "materialSpecification",
                                "testData": "\u51b0\u864ealpicool,C50 AC\/DC,\u6570\u7801\u5c4fAPP,\u78c1\u5438\u95e8,\u5e26\u706f\u5e26\u6392\u6c34\u585e,\u56fd\u4ea7\u538b\u7f29\u673a,R134A",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 189,
                                "top": 180,
                                "height": 58.5,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 288,
                                "top": 180,
                                "height": 88.5,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 391.5,
                                "top": 180,
                                "height": 88.5,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.vline",
                            "options": {
                                "left": 475.5,
                                "top": 180,
                                "height": 28.5,
                                "width": 9
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 180,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 184.5,
                                "height": 21,
                                "width": 115.5,
                                "field": "manufacturerName",
                                "testData": "\u4f5b\u5c71\u5e02\u827e\u51ef\u63a7\u80a1\u96c6\u56e2\u6709\u9650\u516c\u53f8 ",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 397.5,
                                "top": 186,
                                "height": 18,
                                "width": 78,
                                "title": "\u5c0f\u6279\u8bd5\u4ea7",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 481.5,
                                "top": 186,
                                "height": 18,
                                "width": 99,
                                "field": "isSmallProductionPrint",
                                "testData": "\u662f, \u6570\u91cf:10",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 193.5,
                                "top": 186,
                                "height": 18,
                                "width": 85.5,
                                "title": "\u5236\u9020\u5546\u4ea7\u54c1\u578b\u53f7",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 294,
                                "top": 190.5,
                                "height": 9.75,
                                "width": 94.5,
                                "field": "manufacturer_model",
                                "testData": "A01001"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 184.5,
                                "height": 19.5,
                                "width": 55.5,
                                "title": "\u5236\u9020\u5546",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 208.5,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 193.5,
                                "top": 214.5,
                                "height": 16.5,
                                "width": 85.5,
                                "title": "\u8ba4\u8bc1\u56de\u6570",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 214.5,
                                "height": 16.5,
                                "width": 112.5,
                                "field": "sampleQtyPrint",
                                "testData": "1 Pcs",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 214.5,
                                "height": 18,
                                "width": 55.5,
                                "title": "\u6837\u54c1\u6570\u91cf",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 294,
                                "top": 216,
                                "height": 16.5,
                                "width": 93,
                                "field": "sealCountPrint",
                                "testData": "1 \u56de",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 238.5,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 244.5,
                                "height": 19.5,
                                "width": 208.5,
                                "field": "categoryName",
                                "testData": "\u7535\u5b50",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 294,
                                "top": 244.5,
                                "height": 19.5,
                                "width": 93,
                                "title": "\u8ba4\u8bc1\u7406\u7531",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 244.5,
                                "height": 19.5,
                                "width": 55.5,
                                "title": "\u7c7b\u522b",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 397.5,
                                "top": 244.5,
                                "height": 19.5,
                                "width": 184.5,
                                "field": "evaluationName",
                                "testData": "\u65b0\u7269\u6599\u8ba4\u5b9a",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 268.5,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 271.5,
                                "height": 21,
                                "width": 57,
                                "title": "\u9644\u4ef6\u8bf4\u660e",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 271.5,
                                "height": 21,
                                "width": 508.5,
                                "field": "attachmentDescriptionName",
                                "testData": "\u4ea7\u54c1\u89c4\u683c",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 294,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 298.5,
                                "height": 13.5,
                                "width": 55.5,
                                "title": "\u8d44\u6599\u786e\u8ba4",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 298.5,
                                "height": 13.5,
                                "width": 508.5,
                                "field": "data_validation",
                                "testData": "xxx",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.hline",
                            "options": {
                                "left": 3,
                                "top": 316.5,
                                "height": 9,
                                "width": 583.5
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 72,
                                "top": 322.5,
                                "height": 19.5,
                                "width": 508.5,
                                "field": "evaluationContentName",
                                "testData": "\u673a\u68b0\u6027\u80fd",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.text",
                            "options": {
                                "left": 7.5,
                                "top": 322.5,
                                "height": 19.5,
                                "width": 55.5,
                                "title": "\u8ba4\u8bc1\u8bc4\u4ef7\u5185\u5bb9",
                                "textContentVerticalAlign": "middle"
                            }
                        },
                        {
                            "tid": "normalPrint.tableCustom",
                            "options": {
                                "left": 3,
                                "top": 358.5,
                                "height": 36,
                                "width": 585,
                                "field": "auditList",
                                "textAlign": "center",
                                "columns": [
                                    [
                                        {
                                            "title": "\u8282\u70b9",
                                            "field": "node_name",
                                            "width": 177.20414201183434,
                                            "colspan": 1,
                                            "rowspan": 1,
                                            "checked": true,
                                            "columnId": "node_name"
                                        },
                                        {
                                            "title": "\u65f6\u95f4",
                                            "field": "auditTime",
                                            "width": 90,
                                            "colspan": 1,
                                            "rowspan": 1,
                                            "checked": true,
                                            "columnId": "auditTime"
                                        },
                                        {
                                            "title": "\u5ba1\u6838\u4eba",
                                            "field": "auditorNickname",
                                            "width": 64.4378698224852,
                                            "colspan": 1,
                                            "rowspan": 1,
                                            "checked": true,
                                            "columnId": "auditorNickname"
                                        },
                                        {
                                            "title": "\u5ba1\u6838\u60c5\u51b5",
                                            "field": "applicantStatusName",
                                            "width": 76.15384615384615,
                                            "colspan": 1,
                                            "rowspan": 1,
                                            "checked": true,
                                            "columnId": "applicantStatusName"
                                        },
                                        {
                                            "title": "\u5907\u6ce8",
                                            "field": "comment",
                                            "width": 177.20414201183434,
                                            "colspan": 1,
                                            "rowspan": 1,
                                            "checked": true,
                                            "columnId": "comment"
                                        }
                                    ]
                                ]
                            }
                        }
                    ],
                    "paperNumberLeft": 565,
                    "paperNumberTop": 819,
                    "topOffset": 2,
                    "leftOffset": 2,
                    "orient": 1
                }
            ]
        },
        "data": {
            "isSmallProductionPrint": "\u5426",
            "sampleQtyPrint": "0 Pcs",
            "sealCountPrint": "2 \u56de",
            "creatorNickname": "\u8d85\u7ea7\u7ba1\u7406\u5458",
            "updatorNickname": "\u8d85\u7ea7\u7ba1\u7406\u5458",
            "cancelerNickname": null,
            "projectTypeName": "\u672a\u5206\u7c7b\u7814\u53d1\u9879\u76ee",
            "projectTypeNumber": "YFXM000000",
            "materialName": "CA3000\u5e10\u7bf7\u4e24\u7528\u7a7a\u8c03\uff08\u6a59\u8272\uff09",
            "materialNumber": "A020023",
            "materialSpecification": "CA3000\uff0c\u56fd\u4ea7\u538b\u7f29\u673a\uff0cR134a\uff0c\u65e0\uff0c\u8f66\u5bb6\u4e24\u7528\uff0c\u7a7a\u8c03",
            "materialUnitName": "Pcs",
            "materialUnitNumber": "Pcs",
            "billTypeName": "\u6807\u51c6\u5c01\u6837\u5355",
            "billTypeCode": "STANDARD",
            "useOrgName": "\u4f5b\u5c71\u5e02\u827e\u51ef\u63a7\u80a1\u96c6\u56e2\u6709\u9650\u516c\u53f8",
            "useOrgNumber": "100",
            "departmentName": "\u6280\u672f\u90e8",
            "departmentNumber": "BM000006",
            "sealTypeName": "\u7ed3\u6784",
            "deliverySampleTypeName": "\u5426",
            "supplyStateName": "\u6b63\u5e38\u4f9b\u5e94",
            "categoryName": "\u7535\u5b50",
            "evaluationName": "\u6750\u6599\u53d8\u66f4\u8ba4\u5b9a",
            "divisionName": "\u540e\u88c5\u4e8b\u4e1a\u90e8",
            "manufacturerName": "\u4e2d\u5c71\u5e02\u817e\u5b87\u5851\u6599\u5236\u54c1\u6709\u9650\u516c\u53f8",
            "manufacturerNumber": "VEN00145",
            "infoStatusName": "\u91cd\u65b0\u5ba1\u6838",
            "cancelStatusName": "\u6b63\u5e38",
            "canSealName": "\u5426",
            "isSmallProductionName": "\u5426",
            "matrialAttrName": "\u81ea\u5236",
            "recycleStatusName": "\u6b63\u5e38",
            "attachmentDescriptionName": "\u4ea7\u54c1\u89c4\u683c\u4e66,\u6837\u54c1\u56fe\u7247",
            "id": 30,
            "team_id": 3,
            "info_code": "FBS20241106008",
            "info_name": "\u6d4b\u8bd5",
            "bill_type_id": 1,
            "remark": "",
            "use_org_id": 1,
            "department_id": 116988,
            "division_id": 62,
            "seal_type": 1,
            "project_type_id": "654b40f5be0e71",
            "material_id": 129265,
            "material_attr": "2",
            "drawing_no": "23232",
            "temp_range": "10\u00b0C~-60\u00b0C",
            "recycle_info_code": "",
            "delivery_sample_type": 5,
            "can_seal": "N",
            "seal_condition": "",
            "delivery_cycle": "2",
            "supply_state": "7",
            "supply_start": "2024-11-04",
            "supply_end": "2099-12-31",
            "model": "\u6d4b",
            "manufacturer_id": 140134,
            "manufacturer_model": "\u662f",
            "sample_qty": "0.00",
            "is_small_production": "N",
            "small_production_qty": "0.00",
            "category_id": 17,
            "seal_count": 2,
            "evaluation_id": 24,
            "attachment_description_id": "30,31",
            "evaluation_content_id": "36",
            "data_validation": "0",
            "sample_document_id": "",
            "sample_document_name": "",
            "info_status": "REVIEW",
            "cancel_status": "ENABLE",
            "recycle_status": "NORMAL",
            "create_time": "2024-11-06 10:07:42",
            "update_time": "2024-11-26 13:51:46",
            "audit_time": null,
            "cancel_time": null,
            "recycle_time": null,
            "creator_id": 1,
            "updator_id": 1,
            "canceler_id": null,
            "detailList": [
                {
                    "attachmentCategoryName": "\u73af\u4fdd\u4fe1\u606f",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_EP",
                    "attachmentTypeName": "VOCs",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_EP_VOCS",
                    "lastModifierName": null,
                    "id": 354,
                    "bill_id": 30,
                    "attachment_category_id": 45,
                    "attachment_type_id": 48,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "\u73af\u4fdd\u4fe1\u606f",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_EP",
                    "attachmentTypeName": "RoHS",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_EP_ROHS",
                    "lastModifierName": null,
                    "id": 355,
                    "bill_id": 30,
                    "attachment_category_id": 45,
                    "attachment_type_id": 49,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "\u73af\u4fdd\u4fe1\u606f",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_EP",
                    "attachmentTypeName": "MDS\uff08\u6750\u6599\u6210\u5206\u8868\uff09",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_EP_MDS",
                    "lastModifierName": null,
                    "id": 356,
                    "bill_id": 30,
                    "attachment_category_id": 45,
                    "attachment_type_id": 50,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "\u73af\u4fdd\u4fe1\u606f",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_EP",
                    "attachmentTypeName": "\u6c14\u5473\u62a5\u544a\uff08\u5916\u90e8\uff09",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_EP_ODORREPORT",
                    "lastModifierName": null,
                    "id": 357,
                    "bill_id": 30,
                    "attachment_category_id": 45,
                    "attachment_type_id": 51,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "\u4f9b\u5e94\u5546\u8d44\u8d28\u8d44\u6599",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_SUPPLIER",
                    "attachmentTypeName": "\u8ba4\u8bc1\u8981\u6c42",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_SUPPLIER_CR",
                    "lastModifierName": null,
                    "id": 358,
                    "bill_id": 30,
                    "attachment_category_id": 46,
                    "attachment_type_id": 52,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "\u4f9b\u5e94\u5546\u8d44\u8d28\u8d44\u6599",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_SUPPLIER",
                    "attachmentTypeName": "\u6750\u8d28\u8bc1\u660e",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_SUPPLIER_MC",
                    "lastModifierName": null,
                    "id": 359,
                    "bill_id": 30,
                    "attachment_category_id": 46,
                    "attachment_type_id": 53,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "\u4f9b\u5e94\u5546\u8d44\u8d28\u8d44\u6599",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_SUPPLIER",
                    "attachmentTypeName": "\u6a21\u5177\u56fe\u7eb8",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_SUPPLIER_TEST",
                    "lastModifierName": null,
                    "id": 362,
                    "bill_id": 30,
                    "attachment_category_id": 46,
                    "attachment_type_id": 56,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "SQE\u8865\u5145\u8d44\u6599",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_DQE",
                    "attachmentTypeName": "SQE\u8865\u5145\u8d44\u6599",
                    "attachmentTypeCode": "FBSAMPLE_REPLENISH_CATEGORY_DQE_ODORREPORT",
                    "lastModifierName": null,
                    "id": 365,
                    "bill_id": 30,
                    "attachment_category_id": 47,
                    "attachment_type_id": 59,
                    "attachment_count": 0,
                    "required": 1,
                    "last_modification_time": null,
                    "last_modifier_id": null
                },
                {
                    "attachmentCategoryName": "SQE\u8865\u5145\u8d44\u6599",
                    "attachmentCategoryCode": "FBSAMPLE_REPLENISH_CATEGORY_DQE",
                    "attachmentTypeName": "\u6c14\u5473\u62a5\u544a\uff08\u5185\u90e8\uff09",
                    "attachmentTypeCode": "Del-FBSAMPLE_REPLENISH_CATEGORY_DQE_TESTREPORT",
                    "lastModifierName": null,
                    "id": 631,
                    "bill_id": 30,
                    "attachment_category_id": 47,
                    "attachment_type_id": 63,
                    "attachment_count": 0,
                    "required": 0,
                    "last_modification_time": null,
                    "last_modifier_id": null
                }
            ],
            "division": {
                "id": 62,
                "create_time": "2024-10-24 16:19:37",
                "update_time": "2024-10-24 16:19:37",
                "category_id": 9,
                "parent_id": 0,
                "name": "\u540e\u88c5\u4e8b\u4e1a\u90e8",
                "code": "FBSAMPLE_SEAL_DIVISION_AFTER",
                "sort": 99,
                "has_clirden": 0,
                "cancel_status": "ENABLE",
                "content": ""
            },
            "manufacturer": {
                "FSupplierId": 140134,
                "FNumber": "VEN00145",
                "FName": "\u4e2d\u5c71\u5e02\u817e\u5b87\u5851\u6599\u5236\u54c1\u6709\u9650\u516c\u53f8",
                "FShortName": " ",
                "FDescription": " ",
                "FUseOrgId": 1,
                "FUseOrgId__FNumber": "100",
                "FUseOrgId__FName": "\u4f5b\u5c71\u5e02\u827e\u51ef\u63a7\u80a1\u96c6\u56e2\u6709\u9650\u516c\u53f8",
                "FDocumentStatus": "C",
                "FForbidStatus": "A",
                "FCreateDate": "2021-05-20 10:17:01",
                "FModifyDate": "2023-05-29 15:32:54",
                "FForbidDate": null,
                "FAuditDate": "2022-11-09 16:45:21",
                "create_time": "2024-10-24 16:21:04",
                "update_time": "2024-10-24 16:21:04"
            },
            "auditList": [],
            "onlyApproveList": [],
            "__pfd_file_name": "FBS20241106008-A020023-CA3000\u5e10\u7bf7\u4e24\u7528\u7a7a\u8c03\uff08\u6a59\u8272\uff09"
        }
    }
EOT;
$jsonArr = json_decode($json,JSON_OBJECT_AS_ARRAY);
$clientid='web';
$taskid=time();
$data=[
    'clientid'=>$clientid,
    'taskid'=>$taskid,
    'status'=>'INIT',// INIT(创建),RUNNING(获取后变更状态),FINISH(上传pdf状态),下载完成后自动删除该任务
    'pdfname'=>'',// pdf文件
    'taskdata'=>$jsonArr
];
$postData = [
    'data'=>base64_encode(json_encode($data)),
    'timestamp'=>time(),
];
$postData['sign']=data_md5_key($postData);
$response = curlPost('http://127.0.0.1:8000/addtask.php',$postData)?:'';
$responseData = @json_decode($response,JSON_OBJECT_AS_ARRAY)?:[];

$pdfBase64 = Arr::varPath($responseData,'info.pdf')?:'';
$mimeType = Arr::varPath($responseData,'info.mimetype')?:'';
$fileName = sprintf('%s-%s.pdf',$clientid,$taskid);

$pdfFilecontent = base64_decode($pdfBase64);
$fileSize = strlen($pdfFilecontent);

header('Content-Description: File Transfer');
header('Content-Type: ' . $mimeType);
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . $fileSize);
echo $pdfFilecontent;
