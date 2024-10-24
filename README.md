# 職前測驗
## 資料庫測驗
### 題目一
`請寫出一條查詢語句 (SQL)，列出在 2023 年 5 月下訂的訂單，使用台幣付款且5月總金額最多的前 10 筆的旅宿 ID (bnb_id), 旅宿名稱 (bnb_name), 5 月總金額 (may_amount)`
*Answer:*
```sql
SELECT orders.bnb_id, bnbs.name AS bnb_name, orders.amount AS may_amount FROM orders LEFT JOIN bnbs ON orders.bnb_id = bnbs.id WHERE orders.currency = 'TWD' AND orders.create_at BETWEEN '2024-05-01' AND '2024-05-31' ORDER BY orders.amount LIMIT 10
```
### 題目二
`在題目一的執行下，我們發現 SQL 執行速度很慢，您會怎麼去優化？請闡述您怎麼判斷與優化的方式`
*Answer:*
    首先會先把重點查詢以及作為foreign key的column加上index，然後會使用EXPLAIN `query` 去檢示效果，如type未如理想，會先考慮能否使用EXPLAIN所提供的possible_key作查詢的key，之後會檢查WHERE CONDITION有沒有能夠優化的地方（如使用UNION替代OR，盡量使用`>=,<=`而非`>,<`）。
## API實作測驗
### 題目一
`
請用 Laravel 實作一個提供訂單格式檢查與轉換的 API
   *此應用程式將有一支 endpoint 為 POST /api/orders 的 API 作為輸入點
   *此 API 將以以下固定的 JSON 格式輸入，並請使用 Laravel 的 FormRequest，若未使
用 FormRequest 物件，不予給分
   *請按照循序圖實作此 API 的互動類別及其衍生類別。實作之類別需符合物件導向設計
原則 SOLID 與設計模式。並於該此專案的 README.md 說明您所使用的 SOLID 與
設計模式分別為何。
   *此 API 需按照以下心智圖之所有情境，處理訂單檢查格式與轉換的功能。
   *以下所有情境皆需附上單元測試，覆蓋成功與失敗之案例。
   *請使用 docker 包裝您的環境。若未使用 docker 或 docker-compose 不予給分
   *實作結果需以 GitHub 呈現。若未使用不予給分
`

