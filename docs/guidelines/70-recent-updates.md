# 70 – Anotações rápidas (últimas mudanças)

Referência breve para ajustes recentes já implementados no app.

## Pedidos
- Rota listagem: `GET /orders` (`orders.index`) com busca por ID ou nome do sujeito.
- Rota detalhe: `GET /orders/{order}` (`orders.show`) mostrando sujeito, itens, solicitante, links para pagamento e suporte.
- Menu superior inclui links para "Pedidos" e "Novo Pedido".
- Dashboard exibe últimos pedidos, total de pedidos recentes e saldo em carteira, com link "Detalhes" por linha.

## Suporte
- Contato: `GET /contato` (`support.contact`) usa componente Livewire; aceita query `?order=` para pré-preencher o pedido; usuários autenticados preenchem nome/e-mail automaticamente.
- Pagamento do pedido inclui botão para abrir suporte do pedido.

## Saldo / Carteira
- Rota saldo: `GET /saldo` (`wallet.balance`) mostra saldo e últimas transações.
- Recarga simples: `POST /saldo` (`wallet.add`) cria transação `credit/recharge` e incrementa `wallet.balance`.
- Pagamento com saldo: `POST /orders/{order}/payment/wallet` debita saldo, cria payment `wallet/paid` e transaction `debit/order_payment`.
