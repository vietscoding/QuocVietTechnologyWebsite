```mermaid
erDiagram
  USER ||--o{ CART : has
  USER ||--o{ ORDER : places
  USER ||--o{ REVIEW : writes
  USER ||--o{ ADDRESS : owns

  CART ||--|{ CART_ITEM : includes
  CART_ITEM }|--|| PRODUCT : contains

  ORDER ||--|{ ORDER_ITEM : contains
  ORDER_ITEM }|--|| PRODUCT : contains
  ORDER ||--|| ADDRESS : delivers_to

  PRODUCT ||--o{ REVIEW : receives
  PRODUCT ||--|{ PRODUCT_IMAGE : has
  PRODUCT }o--|| CATEGORY : belongs_to

  REVIEW ||--o{ REVIEW_REPLY : can_have

  USER {
    int id PK
    string name
    string email
    string password
    string role
    datetime created_at
    datetime updated_at
  }

  ADDRESS {
    int id PK
    int user_id FK
    string recipient_name
    string line1
    string line2
    string city
    string state
    string country
    string postal_code
    boolean is_default
    datetime created_at
  }

  CART {
    int id PK
    int user_id FK
    datetime created_at
    datetime updated_at
    string status  %% e.g. active, converted, abandoned %%
  }

  CART_ITEM {
    int id PK
    int cart_id FK
    int product_id FK
    int quantity
  }

  ORDER {
    int id PK
    int user_id FK
    int address_id FK
    decimal total_amount
    string status  %% e.g. pending, paid, shipped, delivered, cancelled %%
    datetime created_at
    datetime updated_at
  }

  ORDER_ITEM {
    int id PK
    int order_id FK
    int product_id FK
    int quantity
    decimal unit_price
    decimal original_price
  }

  PRODUCT {
    int id PK
    string name
    string description
    decimal price
    string brand
    int stock
    int category_id FK
    datetime created_at
    datetime updated_at
  }

  CATEGORY {
    int id PK
    string name
    string description
  }

  PRODUCT_IMAGE {
    int id PK
    int product_id FK
    string url
    boolean is_primary
  }

  REVIEW {
    int id PK
    int user_id FK
    int product_id FK
    int rating
    string comment
    boolean verified_purchase
    datetime created_at
    datetime updated_at
  }

  REVIEW_REPLY {
    int id PK
    int review_id FK
    int user_id FK  %% admin or seller phản hồi %%
    string comment
    datetime created_at
  }

```