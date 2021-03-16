import React, { useState, useEffect, useRef } from 'react'
import {Form, ListGroup, Card} from 'react-bootstrap'


const Search = () => {

    const [query, setQuery] = useState('')
    const [search, setSearch] = useState([])
    const [product, setProduct] = useState([])
    const [customer, setCustomer] = useState([])
    const focusSearch = useRef(null)

    useEffect(() => {focusSearch.current.focus()}, [])

    const getSearch = async (query) => {
        const results = await fetch(`http://localhost/api/aprilsix/search?search=${query}`, {
            headers: {'accept': 'application/json'}
        })
        const searchData = await results.json()
        return searchData.data
    }

    const sleep = (ms) => {
        return new Promise(resolve => setTimeout(resolve, ms))
    }

    useEffect(() => {
        let currentQuery = true
        const controller = new AbortController()

        const loadSearch = async () => {
            if (!query) return setSearch([])

            await sleep(350)
            if (currentQuery) {
                const search = await getSearch(query, controller)
                setSearch(search)
                setCustomer(search.customer)
                setProduct(search.product)

            }
        }
        loadSearch()

        return () => {
            currentQuery = false
            controller.abort()
        }
    }, [query])






    return (
        <>
            <div className="w-75 mt-5" style={{marginLeft: "20%"}}>
                <Form id="search-form">
                    <h4>Search For Product Or Customers</h4>
                    <Form.Control
                        type="email"
                        placeholder="Search for a product or customer..."
                        ref={focusSearch}
                        onChange={(e) => setQuery(e.target.value)}
                        value={query}
                    />
                </Form>

                <div className='row mb-4'>


                {
                    customer && customer.length > 0 ?
                        customer.map((customer, index) => {
                            return (
                            <Card key={index} className='m-4' variant="secondary" style={{ width: '18rem' }}>
                                <Card.Body>
                                    <Card.Title>{customer.ref}</Card.Title>
                                    <Card.Subtitle className="mb-2 text-muted">{customer.name}</Card.Subtitle>
                                    <Card.Text>
                                        {customer.address}
                                    </Card.Text>
                                </Card.Body>
                            </Card>
                            )
                        })
                        :
                        <ListGroup.Item action variant="secondary">
                            No Customer
                        </ListGroup.Item>
                }
                {
                    product && product.length > 0 ?
                        product.map((product, index) => {
                            return (
                                <Card key={index} className='m-4' variant="secondary" style={{ width: '18rem' }}>
                                    <Card.Body>
                                        <Card.Title>{product.part_number}</Card.Title>
                                        <Card.Subtitle className="mb-2 text-muted">{product.category}</Card.Subtitle>
                                        <Card.Text>
                                            {product.description}
                                        </Card.Text>
                                    </Card.Body>
                                </Card>
                            )
                        })
                        :
                        <ListGroup.Item action variant="primary">
                            No Products
                        </ListGroup.Item>
                }
                </div>
            </div>
        </>
    )
}

export default Search
