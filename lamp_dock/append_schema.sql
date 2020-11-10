-- 購入履歴
CREATE TABLE purchase_history(
    history_id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NOT NULL,
    created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(history_id)
);

-- 購入明細
CREATE TABLE purchase_details(
    details_id int(11) NOT NULL AUTO_INCREMENT,
    history_id int(11) NOT NULL,
    item_id int(11) NOT NULL,
    price int(11) NOT NULL,
    amount int(11) NOT NULL,
    PRIMARY KEY(details_id)
);