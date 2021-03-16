import React from 'react'
import axios from 'axios'
import { useSpring, animated } from 'react-spring'
import {Table} from 'react-bootstrap'

const TABLE = () => {
    const URL = `http://localhost/api/aprilsix/customers`

    const [data, setData] = React.useState({ customers: [] })
    const [total, setTotal] = React.useState('')
    const [page, setPage] = React.useState()
    const [lastPage, setLast] = React.useState()
    const [url, setUrl] = React.useState(URL)
    const [next, setNext] = React.useState('')
    const [prev, setPrev] = React.useState('')
    const [paginate, setPaginate] = React.useState(10)
    const [pageCount, setPageCount] = React.useState(1)
    const gotopage = React.useRef(null)
    const fadeAnime = useSpring({
        from: { opacity: 0 },
        to: { opacity: 1 }
    })

    React.useEffect(() => {
        const fetchCustomers = () => {
            axios.get(url)
                .then(res => {
                    setData({ customers: [...res.data.data] })
                    setTotal(res.data.meta.total)
                    setPage(res.data.meta.current_page)
                    setNext(`${res.data.next_page_url}&per_page=${paginate}`)
                    setPrev(`${res.data.prev_page_url}&per_page=${paginate}`)
                    setLast(res.data.last_page)
                    setPageCount(Math.ceil(total / paginate))

                }).catch(e => console.log(e))
        }
        fetchCustomers();
    }, [url, next, prev, paginate, page])

    function show(event) {
        let show = event.target.value;
        setPaginate(show)
        let uri = `${URL}?per_page=${show}`
        setUrl(uri)
    }

    function goTo(event) {
        let pageNumber = Math.min(event.target.value, pageCount)
        setPage(pageNumber)
        let uri = `${URL}?page=${pageNumber}&per_page=${paginate}`
        setUrl(uri)
    }

    function nextPage() {
        let pageNumber = page + 1
        setPage(pageNumber)
        let uri = `${URL}?page=${pageNumber}`
        setUrl(uri)
    }

    return (
        <div className="w-75 mt-5" style={{marginLeft: "20%"}}>
            <div className="container mb-5">
                <div className="col-lg-4">
                    Show <select className="pager" name="show" onChange={(e) => show(e)}>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value={total}>All</option>
                </select>
                    Out of {total}
                </div>
                <div className="col-lg-4"><br></br></div>
            </div>
            <hr></hr>
            <div className="">
                {
                    <Table  width="100" striped bordered hover variant="dark">

                            <thead>
                            <tr>
                                <th>Part Number</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                            </tr>
                            </thead>

                        {
                            data.customers.length > 0 ?
                                data.customers.map((customers, index) => (
                                    <tbody>
                                        <tr>
                                            <td key={customers + Math.random()}>{customers.ref}</td>
                                            <td key={customers + Math.random()}>{customers.name}</td>
                                            <td key={customers + Math.random()}>{customers.email}</td>
                                            <td key={customers + Math.random()}>{customers.address}</td>
                                        </tr>
                                    </tbody>

                            ))
                                :
                                <tbody>
                                <tr>
                                    <td>No Customers!</td>
                                </tr>
                                </tbody>
                        }
                    </Table>

                }
            </div>
            <hr></hr>
            <div className="container bottom-pager">
                <div className="row">
                    <div className="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <button disabled={page !== 1 ? false : true} onClick={() => setUrl(prev)} className="btn btn-sm btn-dark">Prev</button>
                        <button disabled={page !== lastPage ? false : true} onClick={() => { nextPage() }} className="btn btn-sm btn-success">Next</button>
                    </div>

                    <div className="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <span className="">Page <input  ref={gotopage} type="number" className="pager" name="goto" onChange={(e) => goTo(e)} /> of {pageCount} pages</span>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default TABLE
