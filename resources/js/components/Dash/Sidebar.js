import React from "react";

import { Nav } from "react-bootstrap";

const Sidebar = () => (

    <div className=' w-20 vh-100 position-fixed '>

        <Nav  className="flex-column pt-2 ">

            <Nav.Item className="active w-25 p-3">
                <Nav.Link href="/search">
                    Search
                </Nav.Link>
            </Nav.Item>

            <Nav.Item className="w-25 p-3">
                <Nav.Link href="/products">
                    Products
                </Nav.Link>
            </Nav.Item>

            <Nav.Item className='w-25 p-3'>
                <Nav.Link href="/customers">
                    Customers
                </Nav.Link>
            </Nav.Item>

            <Nav.Item className='w-25 p-3'>
                <Nav.Link href="/customers-sales">
                    Customer Sales
                </Nav.Link>
            </Nav.Item>
        </Nav>
    </div>

)

export default Sidebar
