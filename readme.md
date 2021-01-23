# Just a lab for testing purposes

- account (model)

  - id
  - name
  - email
  - password

- product (model)

  - id
  - title
  - price
  - quantity

- cart ("model")

  - id
  - user_id
  - products (json) [json in | json out]
    - id
    - title
    - price
    - sell_quantity

- Admin     (admin stuff)
- Cart      (Control the cart)
- Database  (db class)
- Product   (Product CRUD)
- Routes    (Keep the routes)
- User      (login, register)