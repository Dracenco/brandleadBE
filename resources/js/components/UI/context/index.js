import React, { useState} from 'react'

export const MyContext = React.createContext(undefined);

export const MyProvider = ({ children }) => {
    const [items, setItems] = useState([])

    return (
        <MyContext.Provider value={{ items, setItems }}>
            {children}
        </MyContext.Provider>
    );
}